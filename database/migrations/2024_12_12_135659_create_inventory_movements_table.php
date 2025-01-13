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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_detail_id')->constrained()->cascadeOnDelete(); // Producto relacionado
            $table->foreignId('store_id')->constrained()->onDelete('cascade'); // Tienda o almacén
            $table->foreignId('movement_type_id')->constrained('movement_types')->onDelete('cascade'); // Tipo de movimiento
            $table->integer('quantity'); // Cantidad movida (positivo para entrada, negativo para salida)
            $table->decimal('unit_price', 10, 2)->nullable(); // Precio unitario
            $table->text('description')->nullable(); // Detalles adicionales del movimiento
            $table->boolean('status')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
