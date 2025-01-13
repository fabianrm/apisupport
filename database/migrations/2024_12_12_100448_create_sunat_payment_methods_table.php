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
        Schema::create('sunat_payment_methods', function (Blueprint $table) {
            $table->string('code', 2)->primary(); // Código de la forma de pago (Ejemplo: 01, 02)
            $table->string('description'); // Descripción de la forma de pago (viaja a sunat) (Ejemplo: Contado, Crédito)
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunat_payment_methods');
    }
};
