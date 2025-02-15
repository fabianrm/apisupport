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
        Schema::create('sunat_document_ids', function (Blueprint $table) {
            $table->string('code', 1)->primary(); // Código del tipo de documento identidad (Ejemplo: 0, 1, 4, 6, 7)
            $table->string('description'); // Descripción del tipo (Ejemplo: Gravado - Operación Onerosa)
            $table->integer('lenght'); // Longitud de caracteres
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunat_document_ids');
    }
};
