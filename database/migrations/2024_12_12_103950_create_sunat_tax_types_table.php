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
        Schema::create('sunat_tax_types', function (Blueprint $table) {
            $table->string('code', 2)->primary(); // Código del tipo de afectación al IGV (Ejemplo: 10, 20)
            $table->string('description'); // Descripción del tipo (Ejemplo: Gravado - Operación Onerosa)
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunat_tax_types');
    }
};
