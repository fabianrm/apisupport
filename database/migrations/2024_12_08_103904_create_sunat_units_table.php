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
        Schema::create('sunat_units', function (Blueprint $table) {
            $table->string('code', 3)->primary(); // Código de la unidad de medida (Ejemplo: NIU, ZZ)
            $table->string('description'); // Descripción de la unidad (Ejemplo: Unidad, Servicios Profesionales)
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunat_units');
    }
};
