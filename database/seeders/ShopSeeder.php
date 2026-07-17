<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        // Dapatkan user penjual (id 2,3,4) karena 1 adalah admin
        $penjual_ids = DB::table('users')->where('role', 'penjual')->pluck('id')->toArray();
        
        $shops = [];
        $shop_names = ['Toko Berkah UMKM', 'Warung Bu Tejo', 'Juragan Kerajinan Nusantara'];
        
        foreach ($penjual_ids as $index => $uid) {
            $shops[] = [
                'user_id' => $uid,
                'name' => $shop_names[$index] ?? $faker->company,
                'description' => $faker->paragraph,
                'logo' => null,
                'city_id' => $faker->numberBetween(1, 500),
                'address' => $faker->address,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('shops')->insert($shops);
    }
}