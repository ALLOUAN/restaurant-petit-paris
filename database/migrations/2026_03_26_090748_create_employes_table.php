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
        Schema::create('employes', function (Blueprint $table) {
            $table->increments('id_employe');
            $table->string('matricule', 20)->unique();
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('email', 100)->nullable()->unique();
            $table->string('telephone', 20)->nullable();
            $table->enum('poste', ['Gérant', 'Chef de cuisine', 'Serveur', 'Barman', 'Caissier', 'Plongeur']);
            $table->date('date_embauche');
            $table->decimal('salaire', 10, 2)->nullable();
            $table->boolean('est_actif')->default(true);
            $table->string('mot_de_passe', 255)->nullable();
            $table->dateTime('date_creation')->useCurrent();
            $table->dateTime('date_modification')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
