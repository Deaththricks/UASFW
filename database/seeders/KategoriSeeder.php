<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'nama_kategori' => 'Makanan',
                'deskripsi_kategori' => 'Produk makanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Minuman',
                'deskripsi_kategori' => 'Produk minuman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Snack',
                'deskripsi_kategori' => 'Produk snack',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
