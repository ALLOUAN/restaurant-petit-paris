<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            // Ces vues/procédures sont spécifiques à MySQL.
            return;
        }

        DB::unprepared("
            DROP VIEW IF EXISTS vue_tables_commandes;
            DROP VIEW IF EXISTS vue_alertes_stock;
            DROP VIEW IF EXISTS vue_statistiques_ventes;

            DROP PROCEDURE IF EXISTS generer_numero_commande;
            DROP PROCEDURE IF EXISTS mettre_a_jour_ventes_journalieres;
        ");

        DB::unprepared("
            CREATE VIEW vue_tables_commandes AS
            SELECT
                t.numero_table,
                t.capacite,
                t.emplacement,
                t.etat,
                t.coordonnees_x,
                t.coordonnees_y,
                COALESCE(c.id_commande, 0) as commande_en_cours,
                COALESCE(c.nombre_couverts, 0) as couverts_actuels,
                COALESCE(cl.nom_client, '') as nom_client,
                c.heure_prise_commande as heure_arrivee,
                TIMESTAMPDIFF(MINUTE, c.heure_prise_commande, NOW()) as duree_occupation_minutes
            FROM tables t
            LEFT JOIN commandes c ON t.id_table = c.id_table
                AND c.id_statut IN (2, 3, 4)
            LEFT JOIN clients cl ON c.id_client = cl.id_client
        ");

        DB::unprepared("
            CREATE VIEW vue_alertes_stock AS
            SELECT
                i.id_ingredient,
                i.nom_ingredient,
                i.stock_actuel,
                i.stock_minimal,
                i.unite_mesure,
                f.nom_fournisseur,
                CASE
                    WHEN i.stock_actuel <= 0 THEN 'Rupture'
                    WHEN i.stock_actuel <= i.stock_minimal THEN 'Stock faible'
                    ELSE 'Normal'
                END as niveau_alerte
            FROM ingredients i
            LEFT JOIN fournisseurs f ON i.id_fournisseur = f.id_fournisseur
            WHERE i.stock_actuel <= i.stock_minimal OR i.stock_actuel <= 0
        ");

        DB::unprepared("
            CREATE VIEW vue_statistiques_ventes AS
            SELECT
                DATE(c.date_creation) as date_vente,
                COUNT(*) as nombre_commandes,
                SUM(c.nombre_couverts) as nombre_couverts_total,
                SUM(c.montant_total_ht) as chiffre_affaires_ht,
                SUM(c.montant_total_ttc) as chiffre_affaires_ttc,
                AVG(c.montant_total_ttc) as ticket_moyen,
                CASE
                    WHEN SUM(c.nombre_couverts) > 0 THEN SUM(c.montant_total_ttc) / SUM(c.nombre_couverts)
                    ELSE 0
                END as panier_moyen_couvert
            FROM commandes c
            WHERE c.id_statut = 6
            GROUP BY DATE(c.date_creation)
        ");

        DB::unprepared("
            CREATE PROCEDURE generer_numero_commande()
            BEGIN
                DECLARE numero VARCHAR(20);
                DECLARE compteur INT;

                SET compteur = (
                    SELECT COALESCE(COUNT(*), 0) + 1
                    FROM commandes
                    WHERE DATE(date_creation) = CURDATE()
                );

                SET numero = CONCAT(
                    'CMD-', DATE_FORMAT(CURDATE(), '%Y%m%d'), '-', LPAD(compteur, 4, '0')
                );

                SELECT numero as nouveau_numero_commande;
            END;
        ");

        DB::unprepared("
            CREATE PROCEDURE mettre_a_jour_ventes_journalieres(IN date_vente DATE)
            BEGIN
                INSERT INTO ventes_journalieres (
                    date_vente,
                    nombre_commandes,
                    nombre_couverts_total,
                    chiffre_affaires_ht,
                    chiffre_affaires_ttc,
                    montant_tva_total,
                    panier_moyen,
                    ticket_moyen
                )
                SELECT
                    date_vente,
                    COUNT(*) as nb_cmd,
                    COALESCE(SUM(nombre_couverts), 0) as total_couverts,
                    COALESCE(SUM(montant_total_ht), 0) as ca_ht,
                    COALESCE(SUM(montant_total_ttc), 0) as ca_ttc,
                    COALESCE(SUM(montant_tva), 0) as total_tva,
                    CASE
                        WHEN SUM(nombre_couverts) > 0 THEN SUM(montant_total_ttc) / SUM(nombre_couverts)
                        ELSE 0
                    END as panier_moyen,
                    COALESCE(AVG(montant_total_ttc), 0) as ticket_moyen
                FROM commandes
                WHERE DATE(date_creation) = date_vente AND id_statut = 6
                ON DUPLICATE KEY UPDATE
                    nombre_commandes = VALUES(nombre_commandes),
                    nombre_couverts_total = VALUES(nombre_couverts_total),
                    chiffre_affaires_ht = VALUES(chiffre_affaires_ht),
                    chiffre_affaires_ttc = VALUES(chiffre_affaires_ttc),
                    montant_tva_total = VALUES(montant_tva_total),
                    panier_moyen = VALUES(panier_moyen),
                    ticket_moyen = VALUES(ticket_moyen),
                    date_mise_a_jour = CURRENT_TIMESTAMP;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::unprepared("
            DROP VIEW IF EXISTS vue_tables_commandes;
            DROP VIEW IF EXISTS vue_alertes_stock;
            DROP VIEW IF EXISTS vue_statistiques_ventes;
            DROP PROCEDURE IF EXISTS generer_numero_commande;
            DROP PROCEDURE IF EXISTS mettre_a_jour_ventes_journalieres;
        ");
    }
};
