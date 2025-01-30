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
        Schema::create('repair_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_id')->constrained('repairs')->onDelete('cascade');
            $table->string('file_path'); // direccion
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
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
        Schema::dropIfExists('repair_attachments');
    }
};
