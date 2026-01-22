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
                'nama_kategori' => 'Pasty',
                'deskripsi_kategori' => 'Produk pasty',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Cake',
                'deskripsi_kategori' => 'Produk kue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Others',
                'deskripsi_kategori' => 'Produk lainnya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
