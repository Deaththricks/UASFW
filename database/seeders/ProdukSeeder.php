<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('produks')->insert([
            [
                'id_kategori' => 1,
                'nama_produk' => 'Roti Coklat',
                'deskripsi_produk' => 'Roti isi coklat',
                'harga' => 5000,
                'stok' => 50,
                'gambar_produk' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kategori' => 2,
                'nama_produk' => 'Es Teh',
                'deskripsi_produk' => 'Minuman segar',
                'harga' => 3000,
                'stok' => 100,
                'gambar_produk' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
