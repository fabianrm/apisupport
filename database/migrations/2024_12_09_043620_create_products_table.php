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
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['product', 'part']); // Tipo: producto (product) o repuesto (part)
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Categoria
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade'); // Marca
            $table->foreignId('presentation_id')->constrained('presentations')->onDelete('cascade'); // Presentación
            $table->string('image')->nullable();
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
        Schema::dropIfExists('products');
    }
};
