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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->increments('id_fournisseur');
            $table->string('nom_fournisseur', 100);
            $table->string('contact_personne', 100)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('adresse')->nullable();
            $table->string('code_postal', 10)->nullable();
            $table->string('ville', 50)->nullable();
            $table->string('pays', 50)->default('France');
            $table->string('siret', 14)->nullable();
            $table->integer('delai_livraison')->default(1);
            $table->text('conditions_paiement')->nullable();
            $table->boolean('est_actif')->default(true);
            $table->dateTime('date_creation')->useCurrent();
            $table->dateTime('date_modification')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
