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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del permiso
            $table->string('description')->nullable(); // Descripción opcional
            $table->string('icon')->nullable(); // Icono para el menú del frontend
            $table->string('route')->nullable(); // Ruta asociada al permiso
            $table->foreignId('parent_id')->nullable()->constrained('permissions')->onDelete('cascade'); // Permiso padre
            $table->integer('order')->default(0); // Orden para mostrar en el menú
            $table->boolean('status')->default(true); // Estado del permiso

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
