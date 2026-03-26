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
        Schema::create('details_commande', function (Blueprint $table) {
            $table->increments('id_detail_commande');
            $table->unsignedInteger('id_commande');
            $table->unsignedInteger('id_produit');
            $table->integer('quantite')->default(1);
            $table->decimal('prix_unitaire', 10, 2);
            $table->decimal('montant_ht', 10, 2);
            $table->decimal('tva_taux', 5, 2)->default(10.0);
            $table->decimal('montant_tva', 10, 2);
            $table->decimal('montant_ttc', 10, 2);
            $table->enum('statut_preparation', ['En attente', 'En cours', 'Prêt', 'Servi', 'Annulé'])->default('En attente');
            $table->text('remarques')->nullable();
            $table->dateTime('heure_commande')->useCurrent();
            $table->dateTime('heure_preparation')->nullable();
            $table->dateTime('heure_serveur')->nullable();
            $table->dateTime('date_creation')->useCurrent();

            $table->foreign('id_commande')->references('id_commande')->on('commandes')->cascadeOnDelete();
            $table->foreign('id_produit')->references('id_produit')->on('produits')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_commande');
    }
};
