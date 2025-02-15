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
        Schema::create('sunat_serials', function (Blueprint $table) {
            $table->id();
            $table->string('code')->default('03'); // 01->factura, 03->boleta, etc
            $table->foreignId('store_id')->constrained()->onDelete('restrict'); // Tienda
            $table->string('document');
            $table->string('serial'); // Serie del comprobante (ejemplo: F001)
            $table->integer('correlative'); // Correlativo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunat_serials');
    }
};
