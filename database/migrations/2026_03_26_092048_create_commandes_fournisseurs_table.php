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
        Schema::create('commandes_fournisseurs', function (Blueprint $table) {
            $table->increments('id_commande_fournisseur');
            $table->string('numero_commande', 20)->unique();
            $table->unsignedInteger('id_fournisseur');
            $table->unsignedInteger('id_employe_commande');
            $table->date('date_commande');
            $table->date('date_livraison_prevue')->nullable();
            $table->date('date_livraison_reelle')->nullable();
            $table->decimal('montant_total_ht', 10, 2)->default(0);
            $table->decimal('montant_tva', 10, 2)->default(0);
            $table->decimal('montant_total_ttc', 10, 2)->default(0);
            $table->enum('statut', ['En cours', 'Livrée', 'Partiellement livrée', 'Annulée'])->default('En cours');
            $table->text('remarques')->nullable();
            $table->dateTime('date_creation')->useCurrent();
            $table->dateTime('date_modification')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('id_fournisseur')->references('id_fournisseur')->on('fournisseurs')->restrictOnDelete();
            $table->foreign('id_employe_commande')->references('id_employe')->on('employes')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes_fournisseurs');
    }
};
