<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;

class E2EReviewSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Dapatkan Buyer
        $buyer = User::where('email', 'pembeli1@tokokita.com')->first();
        if (!$buyer) return;

        // 2. Buat Kategori Dummy
        $category = Category::firstOrCreate([
            'name' => 'Gadget E2E',
            'slug' => 'gadget-e2e',
        ]);

        // 3. Dapatkan Penjual & Shop
        $seller = User::where('email', 'penjual1@tokokita.com')->first();
        if (!$seller) return;
        $shop = Shop::firstOrCreate(
            ['user_id' => $seller->id],
            [
                'name' => 'Toko E2E Seller',
                'description' => 'Toko dummy',
            ]
        );

        // 4. Buat Produk Dummy
        $productName = 'Produk E2E Review ' . Str::random(5);
        $product = Product::create([
            'shop_id' => $shop->id,
            'name' => $productName,
            'description' => 'Produk khusus untuk pengetesan E2E Review.',
        ]);
        $product->categories()->attach($category->id);

        $variant = \App\Models\ProductVariant::create([
            'product_id' => $product->id,
            'name' => 'Warna Default',
            'sku' => 'SKU-' . Str::random(5),
            'price' => 100000,
            'weight' => 500,
            'stock' => 10,
        ]);

        // 5. Buat Order 'selesai'
        $order = Order::create([
            'user_id' => $buyer->id,
            'shop_id' => $shop->id,
            'invoice_number' => 'INV-E2E-' . Str::upper(Str::random(8)),
            'total_product_price' => 100000,
            'shipping_cost' => 15000,
            'courier_name' => 'JNE',
            'tracking_number' => 'RESI' . Str::random(10),
            'status' => 'selesai',
        ]);

        // 6. Buat Order Detail
        OrderDetail::create([
            'order_id' => $order->id,
            'variant_id' => $variant->id,
            'quantity' => 1,
            'price_per_unit' => 100000,
        ]);
    }
}
