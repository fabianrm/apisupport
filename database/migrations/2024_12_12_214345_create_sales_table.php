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
            
            // Campos para facturación electrónica
            $table->string('ubl_version')->default('2.1'); // Versión UBL
            $table->string('tipo_operacion', 4)->default('0101'); // Tipo de operación (Catálogo 51)
            $table->string('tipo_documento', 4)->default('01'); // Tipo de documento (Catálogo 01)
            $table->string('serie'); // Serie del comprobante (ejemplo: F001)
            $table->integer('correlativo'); // Correlativo del comprobante
            $table->timestamp('fecha_emision'); // Fecha y hora de emisión
            $table->string('forma_pago', 4)->default('CONT'); // Código de la forma de pago //Objeto
            $table->string('tipo_moneda', 3)->default('PEN');; // Código de la moneda
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null'); // Cliente (puede ser anónimo) - Objeto
            $table->foreignId('store_id')->constrained()->onDelete('restrict'); // Tienda donde se realiza la venta - Objeto
            
            // Campos monetarios
            $table->decimal('mto_oper_gravadas', 12, 2); // Monto operaciones gravadas
            $table->decimal('mto_igv', 12, 2); // Monto IGV
            $table->decimal('valor_venta', 12, 2); // Valor de venta
            $table->decimal('total_impuestos', 12, 2); // Total de impuestos
            $table->decimal('subtotal', 12, 2); // Subtotal
            $table->decimal('mto_imp_venta', 12, 2); // Monto total de la venta
            
            $table->string('xml_path')->nullable(); // Ruta del XML generado
            $table->string('cdr_path')->nullable(); // Ruta del CDR recibido
            $table->enum('estado', ['pendiente', 'acceptada', 'rechazada', 'anulada'])->default('pendiente'); // Estado
            $table->string('hash')->nullable(); // Hash generado para la firma digital
            $table->string('code_legend')->default('1000'); // Monto en letras ' Catalogo 52
            $table->string('value_legend')->nullable(); // Monto en letras ' Catalogo 52
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict'); // Vendedor que realizó la venta
            $table->boolean('active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('restrict');
            $table->timestamps();
            
            // Relación con las tablas normalizadas
            $table->foreign('tipo_operacion')->references('code')->on('sunat_operation_types')->onDelete('restrict');
            $table->foreign('tipo_documento')->references('code')->on('sunat_document_types')->onDelete('restrict');
            $table->foreign('forma_pago')->references('code')->on('sunat_payment_methods')->onDelete('restrict');
            $table->foreign('tipo_moneda')->references('code')->on('sunat_currencies')->onDelete('restrict');

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
