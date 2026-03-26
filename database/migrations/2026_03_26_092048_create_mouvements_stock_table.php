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
        Schema::create('mouvements_stock', function (Blueprint $table) {
            $table->increments('id_mouvement');
            $table->unsignedInteger('id_ingredient');
            $table->enum('type_mouvement', ['Entrée', 'Sortie', 'Retour', 'Perte', 'Inventaire']);
            $table->decimal('quantite', 10, 3);
            $table->decimal('quantite_avant', 10, 3);
            $table->decimal('quantite_apres', 10, 3);
            $table->string('motif', 100)->nullable();
            $table->unsignedInteger('id_commande_associee')->nullable();
            $table->unsignedInteger('id_fournisseur_associee')->nullable();
            $table->unsignedInteger('id_employe_responsable')->nullable();
            $table->dateTime('date_mouvement')->useCurrent();

            $table->foreign('id_ingredient')->references('id_ingredient')->on('ingredients')->restrictOnDelete();
            $table->foreign('id_commande_associee')->references('id_commande')->on('commandes')->nullOnDelete();
            $table->foreign('id_fournisseur_associee')->references('id_fournisseur')->on('fournisseurs')->nullOnDelete();
            $table->foreign('id_employe_responsable')->references('id_employe')->on('employes')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvements_stock');
    }
};
