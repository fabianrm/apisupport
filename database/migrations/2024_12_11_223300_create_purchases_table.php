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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade'); // Proveedor
            $table->date('purchase_date'); // Fecha de compra
            $table->decimal('subtotal', 10, 2); // Total de la compra
            $table->decimal('igv', 10, 2); // Total de la compra
            $table->decimal('total', 10, 2); // Total de la compra
            $table->string('invoice_number')->nullable(); // Número de factura
            $table->boolean('status')->default(true);
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade'); // Almacén
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
        Schema::dropIfExists('purchases');
    }
};
