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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('restrict');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->integer('city_id')->nullable();
            $table->text('address')->nullable();
            $table->enum('status', ['pending', 'aktif', 'ditolak'])->default('pending');
            $table->timestamps();
            $table->index('created_at'); // Index untuk query laporan pertumbuhan toko admin
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};