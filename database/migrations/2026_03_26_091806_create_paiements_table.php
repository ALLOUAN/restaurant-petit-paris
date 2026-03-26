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
        Schema::create('paiements', function (Blueprint $table) {
            $table->increments('id_paiement');
            $table->unsignedInteger('id_commande');
            $table->unsignedInteger('id_mode_paiement');
            $table->decimal('montant_paiement', 10, 2);
            $table->dateTime('date_paiement')->useCurrent();
            $table->string('reference_transaction', 100)->nullable();
            $table->unsignedInteger('id_employe_caissier')->nullable();
            $table->boolean('est_justifie')->default(false);
            $table->text('remarques')->nullable();

            $table->foreign('id_commande')->references('id_commande')->on('commandes')->cascadeOnDelete();
            $table->foreign('id_mode_paiement')->references('id_mode_paiement')->on('modes_paiement')->restrictOnDelete();
            $table->foreign('id_employe_caissier')->references('id_employe')->on('employes')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
