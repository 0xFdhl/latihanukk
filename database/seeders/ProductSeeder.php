<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $elektronik = DB::table('categories')->where('name', 'Elektronik')->value('id');
        $rumahTangga = DB::table('categories')->where('name', 'Peralatan Rumah Tangga')->value('id');
        $fashion = DB::table('categories')->where('name', 'Fashion')->value('id');
        $makanan = DB::table('categories')->where('name', 'Makanan dan Minuman')->value('id');
        $alatTulis = DB::table('categories')->where('name', 'Alat Tulis')->value('id');

        DB::table('products')->insert([
            [
                'category_id' => $elektronik,
                'name' => 'Laptop ASUS',
                'stock' => 10,
                'price' => 8500000,
                'entry_date' => '2026-11-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $elektronik,
                'name' => 'Mouse Logitech',
                'stock' => 25,
                'price' => 150000,
                'entry_date' => '2026-11-02',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $rumahTangga,
                'name' => 'Rice Cooker',
                'stock' => 15,
                'price' => 350000,
                'entry_date' => '2026-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $fashion,
                'name' => 'Kaos Polos',
                'stock' => 30,
                'price' => 75000,
                'entry_date' => '2026-11-04',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $makanan,
                'name' => 'Kopi Sachet',
                'stock' => 100,
                'price' => 2500,
                'entry_date' => '2026-11-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $alatTulis,
                'name' => 'Buku Tulis',
                'stock' => 50,
                'price' => 5000,
                'entry_date' => '2026-11-06',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}