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
        Schema::create('ventes_journalieres', function (Blueprint $table) {
            $table->increments('id_vente_journaliere');
            $table->date('date_vente')->unique();
            $table->integer('nombre_commandes')->default(0);
            $table->integer('nombre_couverts_total')->default(0);
            $table->decimal('chiffre_affaires_ht', 12, 2)->default(0);
            $table->decimal('chiffre_affaires_ttc', 12, 2)->default(0);
            $table->decimal('montant_tva_total', 12, 2)->default(0);
            $table->decimal('panier_moyen', 10, 2)->default(0);
            $table->decimal('ticket_moyen', 10, 2)->default(0);
            $table->dateTime('date_creation')->useCurrent();
            $table->dateTime('date_mise_a_jour')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes_journalieres');
    }
};
