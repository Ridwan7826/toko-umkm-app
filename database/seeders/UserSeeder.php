<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $users = [];
        
        // 1 Admin
        $users[] = [
            'name' => 'Administrator',
            'email' => 'admin@tokokita.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // 3 Penjual
        for ($i = 1; $i <= 3; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => "penjual{$i}@tokokita.com",
                'password' => Hash::make('password'),
                'role' => 'penjual',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // 10 Pembeli
        for ($i = 1; $i <= 10; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => "pembeli{$i}@tokokita.com",
                'password' => Hash::make('password'),
                'role' => 'pembeli',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('users')->insert($users);
    }
}