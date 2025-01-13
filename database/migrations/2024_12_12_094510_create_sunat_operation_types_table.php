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
        Schema::create('sunat_operation_types', function (Blueprint $table) {
            $table->string('code', 4)->primary(); // Código del tipo de operación (Ejemplo: 0101)
            $table->string('description'); // Descripción del tipo de operación (Ejemplo: Venta)
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunat_operation_types');
    }
};
