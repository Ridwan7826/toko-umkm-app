<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Pakaian Pria', 'Pakaian Wanita', 'Makanan Ringan', 'Minuman Tradisional', 
            'Kerajinan Tangan', 'Aksesoris Gadget', 'Perabotan Rumah', 'Sepatu & Sandal',
            'Sembako', 'Kosmetik & Skincare'
        ];

        $data = [];
        foreach ($categories as $cat) {
            $data[] = [
                'name' => $cat,
                'slug' => Str::slug($cat),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('categories')->insert($data);
    }
}