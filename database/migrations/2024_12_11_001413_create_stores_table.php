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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ruc');
            $table->string('location');

            $table->string('ubigeo');
            $table->string('department');
            $table->string('province');
            $table->string('district');
            $table->string('urbanization');
            $table->string('address');
            $table->string('sunat_local_code');

            $table->string('phone')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('restrict'); //Responsable de tienda
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
        Schema::dropIfExists('stores');
    }
};
