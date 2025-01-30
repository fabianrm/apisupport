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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('device_type_id')->constrained('device_types')->onDelete('cascade');
            $table->string('model');
            $table->string('serial_number')->nullable();
            $table->string('imei')->nullable();
            $table->string('lock_code')->nullable();
            $table->text('problem_description')->nullable();
           
            $table->enum('status', ['registrado', 'pendiente', 'atendiendo', 'espera_pase', 'validacion', 'solucionado', 'cancelada']);
           
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade'); // Almacén
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
        Schema::dropIfExists('devices');
    }
};
