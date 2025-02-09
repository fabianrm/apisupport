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
            $table->foreignId('store_id')->constrained()->onDelete('restrict'); // Tienda
            $table->enum('document', ['fv', 'bv', 'nc', 'nd', 'gr'])->default('bv');
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
