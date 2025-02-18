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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['product', 'part', 'service']); // Tipo: producto (product) o repuesto (part)
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Categoria
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade'); // Marca
            $table->string('sunat_unit');
            $table->integer('current_stock')->default(0);
            $table->integer('min_stock')->default(0);

            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
            
            $table->foreign('sunat_unit')->references('code')->on('sunat_units')->onDelete('restrict');
            $table->foreignId('store_id')->constrained('stores')->onDelete('restrict'); // Almacén
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
        Schema::dropIfExists('products');
    }
};
