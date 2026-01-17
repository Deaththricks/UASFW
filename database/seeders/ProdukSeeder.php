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
                'nama_produk' => 'Chocolate Croisant',
                'deskripsi_produk' => 'The perfect croisant filled with chocolate from belgium!',
                'harga' => 5000,
                'stok' => 50,
                'gambar_produk' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kategori' => 2,
                'nama_produk' => 'Red Velvet',
                'deskripsi_produk' => 'Red velvet cake made only using quality ingredients! ',
                'harga' => 3000,
                'stok' => 100,
                'gambar_produk' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kategori' => 2,
                'nama_produk' => 'Black forrest',
                'deskripsi_produk' => 'Avtomat kalashnikov nas darovyu ya nye panyemayu russi ',
                'harga' => 3000,
                'stok' => 100,
                'gambar_produk' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kategori' => 2,
                'nama_produk' => 'Green Forrst',
                'deskripsi_produk' => 'Avtomat kalashnikov nas darovyu ya nye panyemayu russi ',
                'harga' => 3000,
                'stok' => 100,
                'gambar_produk' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kategori' => 2,
                'nama_produk' => 'Green Something idk',
                'deskripsi_produk' => 'Avtomat kalashnikov nas darovyu ya nye panyemayu russi ',
                'harga' => 3000,
                'stok' => 100,
                'gambar_produk' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kategori' => 2,
                'nama_produk' => 'Green black',
                'deskripsi_produk' => 'Avtomat kalashnikov nas darovyu ya nye panyemayu russi ',
                'harga' => 3000,
                'stok' => 100,
                'gambar_produk' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kategori' => 2,
                'nama_produk' => 'RED RISING SUN',
                'deskripsi_produk' => 'Avtomat kalashnikov nas darovyu ya nye panyemayu russi ',
                'harga' => 3000,
                'stok' => 100,
                'gambar_produk' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_kategori' => 2,
                'nama_produk' => 'NIPON!!!!',
                'deskripsi_produk' => 'Avtomat kalashnikov nas darovyu ya nye panyemayu russi ',
                'harga' => 3000,
                'stok' => 100,
                'gambar_produk' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            
        ]);
    }
}
