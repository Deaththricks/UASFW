<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesananSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pesanans')->insert([
            [
                'id_user' => 3, // pelanggan10
                'tanggal_pesanan' => now(),
                'total_pembayaran' => 13000,
                'metode_pembayaran' => 'transfer',
                'status_pesanan' => 'dibayar',
                'bukti_pembayaran' => null,
                'alamat_pengiriman' => 'Rumah Pelanggan',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('detail_pesanans')->insert([
            [
                'id_pesanan' => 1,
                'id_produk' => 1,
                'jumlah' => 2,
                'subtotal' => 10000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_pesanan' => 1,
                'id_produk' => 2,
                'jumlah' => 1,
                'subtotal' => 3000,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
