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
        Schema::create('tables', function (Blueprint $table) {
            $table->increments('id_table');
            $table->string('numero_table', 10)->unique();
            $table->unsignedInteger('id_type_table');
            $table->integer('capacite');
            $table->enum('emplacement', ['Intérieur', 'Terrasse', 'Bar', 'Privé']);
            $table->enum('etat', ['Libre', 'Occupée', 'Réservée', 'En service', 'Nettoyage'])->default('Libre');
            $table->integer('coordonnees_x')->nullable();
            $table->integer('coordonnees_y')->nullable();
            $table->dateTime('date_creation')->useCurrent();

            $table->foreign('id_type_table')->references('id_type_table')->on('types_table')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
