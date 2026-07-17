<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $pembeli_ids = DB::table('users')->where('role', 'pembeli')->pluck('id')->toArray();
        $shops = DB::table('shops')->get();
        
        $statuses = ['menunggu_pembayaran', 'dibayar', 'diproses', 'dikirim', 'selesai', 'dibatalkan'];
        
        $orders = [];
        $order_details = [];
        $payments = [];
        
        for ($i = 1; $i <= 1000; $i++) {
            $shop = $faker->randomElement($shops);
            
            // Get variants from this shop directly from DB
            $shop_variants = DB::table('product_variants')
                ->join('products', 'product_variants.product_id', '=', 'products.id')
                ->where('products.shop_id', $shop->id)
                ->select('product_variants.id', 'product_variants.price')
                ->get();
                
            if ($shop_variants->isEmpty()) continue;
            
            $order_status = $faker->randomElement($statuses);
            $created_at = Carbon::now()->subDays($faker->numberBetween(0, 365)); // last 12 months
            
            $total_price = 0;
            $details = [];
            
            // 1 to 4 items per order
            $item_count = $faker->numberBetween(1, 4);
            $chosen_variants = $faker->randomElements($shop_variants->toArray(), min($item_count, $shop_variants->count()));
            
            foreach ($chosen_variants as $v) {
                $qty = $faker->numberBetween(1, 3);
                $total_price += $v->price * $qty;
                $details[] = [
                    'order_id' => $i, 
                    'variant_id' => $v->id,
                    'quantity' => $qty,
                    'price_per_unit' => $v->price,
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                ];
            }
            
            $shipping_cost = $faker->numberBetween(10, 50) * 1000;
            
            $orders[] = [
                'user_id' => $faker->randomElement($pembeli_ids),
                'shop_id' => $shop->id,
                'invoice_number' => 'INV/' . $created_at->format('Ymd') . '/' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'total_product_price' => $total_price,
                'shipping_cost' => $shipping_cost,
                'courier_name' => $faker->randomElement(['JNE', 'J&T', 'SiCepat', 'Pos Indonesia']),
                'tracking_number' => in_array($order_status, ['dikirim', 'selesai']) ? strtoupper(Str::random(12)) : null,
                'status' => $order_status,
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ];
            
            // Payment
            if ($order_status !== 'menunggu_pembayaran') {
                $payments[] = [
                    'order_id' => $i,
                    'snap_token' => Str::random(32),
                    'payment_method' => $faker->randomElement(['bca_va', 'mandiri_va', 'gopay', 'qris']),
                    'amount' => $total_price + $shipping_cost,
                    'status' => $order_status === 'dibatalkan' ? 'failed' : 'success',
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                ];
            }
            
            foreach ($details as $d) {
                $order_details[] = $d;
            }
        }
        
        foreach (array_chunk($orders, 50) as $chunk) {
            DB::table('orders')->insert($chunk);
        }
        
        foreach (array_chunk($order_details, 50) as $chunk) {
            DB::table('order_details')->insert($chunk);
        }
        
        foreach (array_chunk($payments, 50) as $chunk) {
            DB::table('payments')->insert($chunk);
        }
        
        // Aggregate shop_daily_sales automatically after seeding
        DB::statement("
            INSERT INTO shop_daily_sales (shop_id, date, total_orders, completed_orders, cancelled_orders, gross_revenue, created_at, updated_at)
            SELECT 
                shop_id,
                DATE(created_at) as date,
                COUNT(id) as total_orders,
                SUM(CASE WHEN status = 'selesai' THEN 1 ELSE 0 END) as completed_orders,
                SUM(CASE WHEN status = 'dibatalkan' THEN 1 ELSE 0 END) as cancelled_orders,
                SUM(CASE WHEN status = 'selesai' THEN total_product_price + shipping_cost ELSE 0 END) as gross_revenue,
                NOW(),
                NOW()
            FROM orders
            GROUP BY shop_id, DATE(created_at)
            ON DUPLICATE KEY UPDATE 
                total_orders = VALUES(total_orders),
                completed_orders = VALUES(completed_orders),
                cancelled_orders = VALUES(cancelled_orders),
                gross_revenue = VALUES(gross_revenue),
                updated_at = NOW()
        ");
    }
}