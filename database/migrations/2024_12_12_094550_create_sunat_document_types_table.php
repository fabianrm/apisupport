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
        Schema::create('sunat_document_types', function (Blueprint $table) {
            $table->string('code', 2)->primary(); // Código del tipo de documento (Ejemplo: 01)
            $table->string('description'); // Descripción del documento (Ejemplo: Factura)
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunat_document_types');
    }
};
