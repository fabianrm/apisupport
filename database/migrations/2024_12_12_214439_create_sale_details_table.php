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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade'); // Relación con la venta
            $table->foreignId('purchase_detail_id')->constrained()->cascadeOnDelete(); // producto vendido
            $table->string('sunat_unit'); // Unidad - Catalog. 03
            $table->integer('quantity'); // Cantidad vendida
            $table->decimal('unit_value', 10, 2); // Monto valor unitario sin impuestos
            $table->string('description'); // Descripción del producto o servicio
            $table->decimal('base_igv', 10, 2); // Base imponible del IGV
            $table->decimal('igv_percentage', 5, 2); // Porcentaje del IGV
            $table->decimal('igv', 10, 2); // Monto del IGV
            $table->string('sunat_tax_type', 2); // Tipo de afectación al IGV
            $table->decimal('total_taxes', 10, 2); // Total de impuestos en el detalle
            $table->decimal('value_sale', 10, 2); // Monto valor de venta
            $table->decimal('unit_price', 10, 2); // Precio unitario con impuestos incluidos
            $table->timestamps();

            // Relaciones con las tablas normalizadas
            // $table->foreign('sunat_unit')->references('code')->on('sunat_units')->onDelete('restrict');
            $table->foreign('sunat_tax_type')->references('code')->on('sunat_tax_types')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
