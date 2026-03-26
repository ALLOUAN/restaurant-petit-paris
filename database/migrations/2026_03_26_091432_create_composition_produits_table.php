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
        Schema::create('composition_produits', function (Blueprint $table) {
            $table->increments('id_composition');
            $table->unsignedInteger('id_produit');
            $table->unsignedInteger('id_ingredient');
            $table->decimal('quantite_necessaire', 10, 3);
            $table->dateTime('date_creation')->useCurrent();

            $table->foreign('id_produit')->references('id_produit')->on('produits')->cascadeOnDelete();
            $table->foreign('id_ingredient')->references('id_ingredient')->on('ingredients')->restrictOnDelete();

            $table->unique(['id_produit', 'id_ingredient'], 'unique_composition');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('composition_produits');
    }
};
