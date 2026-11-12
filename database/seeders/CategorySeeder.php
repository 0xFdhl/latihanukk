<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Elektronik', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Peralatan Rumah Tangga', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fashion', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Makanan dan Minuman', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alat Tulis', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}