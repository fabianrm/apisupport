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
            $table->foreignId('store_id')->constrained()->onDelete('restrict'); // Tienda donde se realiza la venta - Objeto
            $table->foreignId('purchase_detail_id')->constrained()->cascadeOnDelete(); // producto vendido
            $table->integer('cantidad'); // Cantidad vendida
            $table->decimal('mto_valor_unit', 10, 2); // Monto valor unitario sin impuestos
            $table->decimal('mto_valor_venta', 10, 2); // Monto valor de venta
            $table->decimal('mto_base_igv', 10, 2); // Base imponible del IGV
            $table->decimal('porcentaje_igv', 5, 2); // Porcentaje del IGV
            $table->decimal('igv', 10, 2); // Monto del IGV
            $table->string('tip_afe_igv', 2); // Tipo de afectación al IGV
            $table->decimal('total_impuestos', 10, 2); // Total de impuestos en el detalle
            $table->decimal('mto_precio_unit', 10, 2); // Precio unitario con impuestos incluidos
            $table->decimal('discount', 10, 2); // Precio unitario con impuestos incluidos
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->timestamps();

            // Relaciones con las tablas normalizadas
            // $table->foreign('sunat_unit')->references('code')->on('sunat_units')->onDelete('restrict');
            $table->foreign('tip_afe_igv')->references('code')->on('sunat_tax_types')->onDelete('restrict');
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
