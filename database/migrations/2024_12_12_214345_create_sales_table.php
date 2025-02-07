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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null'); // Cliente (puede ser anónimo)
            $table->foreignId('store_id')->constrained()->onDelete('cascade'); // Tienda donde se realiza la venta
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Vendedor que realizó la venta

            // Campos para facturación electrónica
            $table->string('ubl_version')->default('2.1'); // Versión UBL
            $table->string('sunat_operation_type', 4)->default('0101'); // Tipo de operación (Catálogo 51)
            $table->string('sunat_document_type', 4)->default('01'); // Tipo de documento (Catálogo 01)
            $table->string('sunat_payment_method', 4)->default('CONT'); // Código de la forma de pago
            $table->string('series'); // Serie del comprobante (ejemplo: F001)
            $table->integer('correlative'); // Correlativo del comprobante
            $table->string('sunat_currency', 3)->default('PEN');; // Código de la moneda
          
            // Campos monetarios
            $table->decimal('mto_oper_gravadas', 12, 2); // Monto operaciones gravadas
            $table->decimal('mto_igv', 12, 2); // Monto IGV
            $table->decimal('total_taxes', 12, 2); // Total de impuestos
            $table->decimal('valor_venta', 12, 2); // Valor de venta
            $table->decimal('subtotal', 12, 2); // Subtotal
            $table->decimal('total', 12, 2); // Monto total de la venta

            // Campos de timestamps
            $table->timestamp('issued_at'); // Fecha y hora de emisión

            $table->string('xml_path')->nullable(); // Ruta del XML generado
            $table->string('cdr_path')->nullable(); // Ruta del CDR recibido
            $table->enum('status', ['pending', 'accepted', 'rejected', 'voided'])->default('pending'); // Estado
            $table->string('hash')->nullable(); // Hash generado para la firma digital
            $table->string('code_legend')->default('1000'); // Monto en letras ' Catalogo 52
            $table->string('value_legend')->nullable(); // Monto en letras ' Catalogo 52
            $table->boolean('active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->timestamps();

            // Relación con las tablas normalizadas
            $table->foreign('sunat_operation_type')->references('code')->on('sunat_operation_types')->onDelete('restrict');
            $table->foreign('sunat_document_type')->references('code')->on('sunat_document_types')->onDelete('restrict');
            $table->foreign('sunat_payment_method')->references('code')->on('sunat_payment_methods')->onDelete('restrict');
            $table->foreign('sunat_currency')->references('code')->on('sunat_currencies')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
