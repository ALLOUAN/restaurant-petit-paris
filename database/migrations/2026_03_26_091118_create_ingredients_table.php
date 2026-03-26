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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->increments('id_ingredient');
            $table->string('nom_ingredient', 100)->unique();
            $table->enum('unite_mesure', ['g', 'kg', 'ml', 'l', 'unité', 'pièce', 'botte', 'paquet']);
            $table->decimal('stock_actuel', 10, 3)->default(0);
            $table->decimal('stock_minimal', 10, 3)->default(0);
            $table->decimal('stock_maximal', 10, 3)->nullable();
            $table->decimal('cout_unitaire', 10, 3)->nullable();
            $table->unsignedInteger('id_fournisseur')->nullable();
            $table->date('date_peremption')->nullable();
            $table->text('conditions_stockage')->nullable();
            $table->boolean('est_actif')->default(true);
            $table->dateTime('date_creation')->useCurrent();
            $table->dateTime('date_modification')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_fournisseur')->references('id_fournisseur')->on('fournisseurs')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
