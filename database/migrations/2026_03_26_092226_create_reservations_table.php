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
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id_reservation');
            $table->unsignedInteger('id_client')->nullable();
            $table->unsignedInteger('id_table')->nullable();
            $table->string('nom_reservation', 100);
            $table->string('telephone', 20)->nullable();
            $table->integer('nombre_personnes');
            $table->date('date_reservation');
            $table->time('heure_reservation');
            $table->integer('duree_estimee')->default(120);
            $table->enum('statut', ['Confirmée', 'En attente', 'Annulée', 'Terminée', 'No-show'])->default('Confirmée');
            $table->text('remarques')->nullable();
            $table->unsignedInteger('id_employe_prise_reservation')->nullable();
            $table->dateTime('date_creation')->useCurrent();
            $table->dateTime('date_modification')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_client')->references('id_client')->on('clients_restaurant')->nullOnDelete();
            $table->foreign('id_table')->references('id_table')->on('tables')->restrictOnDelete();
            $table->foreign('id_employe_prise_reservation')->references('id_employe')->on('employes')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
