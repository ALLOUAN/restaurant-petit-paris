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
        Schema::create('details_commandes_fournisseurs', function (Blueprint $table) {
            $table->increments('id_detail_commande_fournisseur');
            $table->unsignedInteger('id_commande_fournisseur');
            $table->unsignedInteger('id_ingredient');
            $table->decimal('quantite_commandee', 10, 3);
            $table->decimal('prix_unitaire_ht', 10, 3);
            $table->decimal('quantite_livree', 10, 3)->default(0);
            $table->decimal('quantite_restante', 10, 3)->storedAs('quantite_commandee - quantite_livree');
            $table->decimal('montant_ht', 10, 2)->storedAs('quantite_commandee * prix_unitaire_ht');
            $table->decimal('tva_taux', 5, 2)->default(20.0);
            $table->decimal('montant_tva', 10, 2)->storedAs('montant_ht * tva_taux / 100');
            $table->decimal('montant_ttc', 10, 2)->storedAs('montant_ht + montant_tva');
            $table->dateTime('date_creation')->useCurrent();

            $table->foreign('id_commande_fournisseur')->references('id_commande_fournisseur')->on('commandes_fournisseurs')->cascadeOnDelete();
            $table->foreign('id_ingredient')->references('id_ingredient')->on('ingredients')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_commandes_fournisseurs');
    }
};
