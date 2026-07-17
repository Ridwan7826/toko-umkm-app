<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $shops = DB::table('shops')->pluck('id')->toArray();
        $categories = DB::table('categories')->pluck('id')->toArray();
        
        $product_names = [
            'Kemeja Batik Pekalongan', 'Keripik Tempe Balado', 'Kopi Bubuk Robusta', 
            'Tas Anyaman Rotan', 'Gantungan Kunci Kulit', 'Daster Adem Motif Bunga', 
            'Kue Kering Nastar', 'Sepatu Kulit Pria', 'Sambal Bawang Botolan', 
            'Madu Hutan Asli', 'Kerupuk Ikan Tenggiri', 'Kaos Polos Katun'
        ];
        
        $products = [];
        for ($i = 1; $i <= 50; $i++) {
            $name = $faker->randomElement($product_names) . ' ' . $faker->word;
            $products[] = [
                'shop_id' => $faker->randomElement($shops),
                'name' => ucwords($name),
                'description' => $faker->text(200),
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('products')->insert($products);
        
        // Generate Pivot category_product & Product Variants
        $product_ids = DB::table('products')->pluck('id')->toArray();
        $pivot = [];
        $variants = [];
        
        foreach ($product_ids as $pid) {
            // 1 to 2 categories per product
            $cat_ids = $faker->randomElements($categories, $faker->numberBetween(1, 2));
            foreach ($cat_ids as $cid) {
                $pivot[] = [
                    'category_id' => $cid,
                    'product_id' => $pid,
                ];
            }
            
            // 1 to 3 variants per product
            $var_count = $faker->numberBetween(1, 3);
            for ($v = 1; $v <= $var_count; $v++) {
                $variants[] = [
                    'product_id' => $pid,
                    'sku' => 'SKU-' . str_pad($pid, 3, '0', STR_PAD_LEFT) . '-' . $v,
                    'name' => 'Varian ' . $v,
                    'price' => $faker->numberBetween(10, 500) * 1000,
                    'weight' => $faker->numberBetween(100, 2000),
                    'stock' => $faker->numberBetween(0, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        DB::table('category_product')->insert($pivot);
        
        // Chunk insert variants to prevent query too long
        foreach (array_chunk($variants, 50) as $chunk) {
            DB::table('product_variants')->insert($chunk);
        }
    }
}