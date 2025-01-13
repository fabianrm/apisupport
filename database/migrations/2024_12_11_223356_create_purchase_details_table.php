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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('purchases')->onDelete('cascade'); // Relación con la compra
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Producto relacionado
            $table->decimal('purchase_price', 10, 2); // Precio de compra
            $table->decimal('sale_price', 10, 2)->nullable(); // Precio de venta sugerido
            $table->integer('quantity'); // Cantidad comprada
            $table->integer('remaining_quantity')->nullable(); // Cantidad disponible del lote
            $table->string('model')->nullable();
            $table->string('serial')->nullable();
            $table->string('imei')->nullable();
            $table->string('color')->nullable();
            $table->string('capacity')->nullable();
            $table->enum('status', ['new', 'used', 'repair']);
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade'); // Almacén
            $table->string('ubication_detail')->nullable(); // Cantidad disponible del lote
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
        Schema::dropIfExists('purchase_details');
    }
};
