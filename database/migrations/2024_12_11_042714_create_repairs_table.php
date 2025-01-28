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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('device_id')->constrained('devices')->onDelete('cascade');
            $table->foreignId('technician_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->decimal('total_cost', 10, 2)->nullable();
            $table->timestamp('delivery_date')->nullable();

            $table->enum('status', ['registrado', 'pendiente', 'atencion', 'espera_pase', 'validacion', 'solucionado', 'cancelada']);
            $table->enum('priority', ['baja', 'normal', 'alta']);

            // Fechas de estado
            $table->timestamp('assigned_at')->nullable();  // Cuándo fue asignado el ticket
            $table->timestamp('resolved_at')->nullable();  // Cuándo fue resuelto el ticket
            $table->timestamp('closed_at')->nullable();  // Cuándo se cerró el ticket


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
        Schema::dropIfExists('repairs');
    }
};
