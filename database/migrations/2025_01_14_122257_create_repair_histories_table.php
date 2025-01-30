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
        Schema::create('repair_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_id')->constrained('repairs')->onDelete('cascade');
            $table->enum('status', ['pendiente', 'atendiendo', 'espera_pase', 'validacion', 'solucionado', 'cancelada']);
            $table->unsignedBigInteger('changed_by');
            $table->text('comment')->nullable();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->foreign('changed_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('repair_histories');
    }
};
