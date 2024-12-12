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
            $table->string('model')->nullable();
            $table->string('serial')->nullable();
            $table->string('imei')->nullable();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade'); // Almacén
            $table->decimal('purchase_price', 10, 2); // Precio de compra
            $table->decimal('sale_price', 10, 2)->nullable(); // Precio de venta sugerido
            $table->integer('quantity'); // Cantidad comprada
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
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
