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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('shop_id')->constrained('shops')->onDelete('restrict');
            $table->string('invoice_number')->unique();
            $table->decimal('total_product_price', 12, 2);
            $table->decimal('shipping_cost', 12, 2);
            $table->string('courier_name')->nullable();
            $table->string('tracking_number')->nullable();
            $table->enum('status', ['menunggu_pembayaran', 'dibayar', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('menunggu_pembayaran');
            $table->timestamps();
            $table->softDeletes();
            $table->index('status');
            $table->index(['shop_id', 'status', 'created_at']); // Index komposit untuk query dasbor & laporan rentang waktu
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};