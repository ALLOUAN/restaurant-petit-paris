<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('commandes');
        Schema::enableForeignKeyConstraints();

        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id_commande');
            $table->string('numero_commande', 20)->unique();
            $table->unsignedInteger('id_table')->nullable();
            $table->unsignedInteger('id_employe_serveur');
            $table->unsignedInteger('id_client')->nullable();
            $table->unsignedInteger('id_statut')->default(1);
            $table->integer('nombre_couverts')->default(1);
            $table->decimal('montant_total_ht', 10, 2)->default(0);
            $table->decimal('montant_tva', 10, 2)->default(0);
            $table->decimal('montant_total_ttc', 10, 2)->default(0);
            $table->decimal('remise_pourcentage', 5, 2)->default(0);
            $table->decimal('remise_montant', 10, 2)->default(0);
            $table->boolean('service_inclus')->default(true);
            $table->decimal('pourcentage_service', 5, 2)->default(15.0);
            $table->dateTime('heure_prise_commande')->useCurrent();
            $table->dateTime('heure_soumission_cuisine')->nullable();
            $table->dateTime('heure_debut_service')->nullable();
            $table->dateTime('heure_fin_service')->nullable();
            $table->dateTime('heure_paiement')->nullable();
            $table->text('remarques')->nullable();
            $table->boolean('est_emporter')->default(false);
            $table->boolean('est_livraison')->default(false);
            $table->text('adresse_livraison')->nullable();
            $table->dateTime('date_creation')->useCurrent();
            $table->dateTime('date_modification')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_table')->references('id_table')->on('tables')->nullOnDelete();
            $table->foreign('id_employe_serveur')->references('id_employe')->on('employes')->restrictOnDelete();
            $table->foreign('id_client')->references('id_client')->on('clients_restaurant')->nullOnDelete();
            $table->foreign('id_statut')->references('id_statut')->on('statuts_commande')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
