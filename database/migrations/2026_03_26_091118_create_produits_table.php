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
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id_produit');
            $table->string('reference', 30)->unique();
            $table->string('nom_produit', 100);
            $table->text('description')->nullable();
            $table->unsignedInteger('id_categorie');
            $table->decimal('prix_unitaire', 10, 2);
            $table->decimal('cout_production', 10, 2)->nullable();
            $table->decimal('tva', 5, 2)->default(10.0);
            $table->boolean('est_disponible')->default(true);
            $table->boolean('contient_alcool')->default(false);
            $table->json('allergenes')->nullable();
            $table->json('informations_nutritionnelles')->nullable();
            $table->integer('temps_preparation')->default(0);
            $table->string('image_url', 255)->nullable();
            $table->integer('ordre_menu')->default(0);
            $table->dateTime('date_creation')->useCurrent();
            $table->dateTime('date_modification')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_categorie')->references('id_categorie')->on('categories')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
