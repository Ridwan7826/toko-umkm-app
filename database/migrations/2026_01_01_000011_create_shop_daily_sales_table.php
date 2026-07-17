<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('shop_daily_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shops')->cascadeOnDelete();
            $table->date('date');
            $table->integer('total_orders')->default(0);
            $table->decimal('gross_revenue', 12, 2)->default(0);
            $table->integer('completed_orders')->default(0);
            $table->integer('cancelled_orders')->default(0);
            $table->timestamps();
            
            // Mencegah duplikasi data rekap pada hari yang sama
            $table->unique(['shop_id', 'date']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('shop_daily_sales');
    }
};
