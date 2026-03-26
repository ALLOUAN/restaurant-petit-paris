<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantInitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Données de base pour les vues / procédures et le workflow de commande.

        // Catégories
        $categories = [
            1 => ['nom_categorie' => 'Entrées', 'description' => 'Plats froids et chauds pour commencer', 'ordre_affichage' => 1],
            2 => ['nom_categorie' => 'Plats principaux', 'description' => 'Nos spécialités et plats de résistance', 'ordre_affichage' => 2],
            3 => ['nom_categorie' => 'Desserts', 'description' => 'Douces finitions pour votre repas', 'ordre_affichage' => 3],
            4 => ['nom_categorie' => 'Boissons chaudes', 'description' => 'Cafés, thés et autres boissons chaudes', 'ordre_affichage' => 4],
            5 => ['nom_categorie' => 'Boissons froides', 'description' => 'Sodas, jus et boissons rafraîchissantes', 'ordre_affichage' => 5],
            6 => ['nom_categorie' => 'Vins', 'description' => 'Notre sélection de vins français', 'ordre_affichage' => 6],
            7 => ['nom_categorie' => 'Cocktails', 'description' => 'Boissons alcoolisées préparées', 'ordre_affichage' => 7],
            8 => ['nom_categorie' => 'Apéritifs', 'description' => 'Amuse-gueules et entrées légères', 'ordre_affichage' => 8],
        ];

        foreach ($categories as $id => $row) {
            DB::table('categories')->updateOrInsert(
                ['id_categorie' => $id],
                $row + ['created_at' => now(), 'updated_at' => now()]
            );
        }

        // Statuts de commande (id_statut = 6 => "Payée")
        $statuts = [
            1 => ['nom_statut' => 'En attente', 'description' => 'Commande prise, en attente de validation cuisine', 'couleur' => '#FFA500', 'ordre_workflow' => 1],
            2 => ['nom_statut' => 'Validée', 'description' => 'Commande validée et envoyée en cuisine', 'couleur' => '#FFFF00', 'ordre_workflow' => 2],
            3 => ['nom_statut' => 'En préparation', 'description' => 'En cours de préparation par la cuisine', 'couleur' => '#00FFFF', 'ordre_workflow' => 3],
            4 => ['nom_statut' => 'Prête', 'description' => 'Prête à être servie', 'couleur' => '#00FF00', 'ordre_workflow' => 4],
            5 => ['nom_statut' => 'Servie', 'description' => 'En cours de service au client', 'couleur' => '#0000FF', 'ordre_workflow' => 5],
            6 => ['nom_statut' => 'Payée', 'description' => 'Commande terminée et payée', 'couleur' => '#008000', 'ordre_workflow' => 6],
            7 => ['nom_statut' => 'Annulée', 'description' => 'Commande annulée', 'couleur' => '#FF0000', 'ordre_workflow' => 7],
        ];

        foreach ($statuts as $id => $row) {
            DB::table('statuts_commande')->updateOrInsert(
                ['id_statut' => $id],
                $row + ['created_at' => now(), 'updated_at' => now()]
            );
        }

        // Modes de paiement
        $modes = [
            1 => ['nom_mode' => 'Espèces', 'description' => 'Paiement en espèces'],
            2 => ['nom_mode' => 'Carte bancaire', 'description' => 'Paiement par carte bleue'],
            3 => ['nom_mode' => 'Chèque', 'description' => 'Paiement par chèque'],
            4 => ['nom_mode' => 'Ticket restaurant', 'description' => 'Tickets restaurant acceptés'],
            5 => ['nom_mode' => 'Virement', 'description' => 'Virement bancaire'],
            6 => ['nom_mode' => 'PayPal', 'description' => 'Paiement en ligne PayPal'],
            7 => ['nom_mode' => 'Lyf Pay', 'description' => 'Paiement mobile Lyf Pay'],
        ];

        foreach ($modes as $id => $row) {
            DB::table('modes_paiement')->updateOrInsert(
                ['id_mode_paiement' => $id],
                $row + ['created_at' => now(), 'updated_at' => now()]
            );
        }

        // Types de tables
        $types = [
            1 => ['nom_type' => 'Table 2 personnes', 'capacite_max' => 2, 'description' => 'Table pour deux personnes'],
            2 => ['nom_type' => 'Table 4 personnes', 'capacite_max' => 4, 'description' => 'Table pour quatre personnes'],
            3 => ['nom_type' => 'Table 6 personnes', 'capacite_max' => 6, 'description' => 'Table pour six personnes'],
            4 => ['nom_type' => 'Table 8 personnes', 'capacite_max' => 8, 'description' => 'Grande table pour huit personnes'],
            5 => ['nom_type' => 'Comptoir', 'capacite_max' => 4, 'description' => 'Places au comptoir'],
            6 => ['nom_type' => 'Terrasse 2', 'capacite_max' => 2, 'description' => 'Table terrasse pour deux'],
            7 => ['nom_type' => 'Terrasse 4', 'capacite_max' => 4, 'description' => 'Table terrasse pour quatre'],
        ];

        foreach ($types as $id => $row) {
            DB::table('types_table')->updateOrInsert(
                ['id_type_table' => $id],
                $row + ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
