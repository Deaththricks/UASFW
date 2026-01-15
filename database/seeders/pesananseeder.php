<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\Hash;

class PesananSeeder extends Seeder
{
    public function run(): void
    {
        $kat = Kategori::firstOrCreate(
            ['nama_kategori' => 'Bakery'],
            ['deskripsi_kategori' => 'Kue dan Roti Segar']
        );

        $user1 = User::firstOrCreate(
            ['user_name' => 'budi_s'],
            [
                'email' => 'budi@gmail.com',
                'password' => Hash::make('password'),
                'nama_lengkap' => 'Budi Santoso',
                'alamat' => 'Jl. Mawar No. 123',
                'no_hp' => '08123456789',
                'role' => 'pelanggan',
            ]
        );

        $user2 = User::firstOrCreate(
            ['user_name' => 'siti_r'],
            [
                'email' => 'siti@gmail.com',
                'password' => Hash::make('password'),
                'nama_lengkap' => 'Siti Rahma',
                'alamat' => 'Jl. Melati No. 45',
                'no_hp' => '08987654321',
                'role' => 'pelanggan',
            ]
        );

        $p1 = Produk::firstOrCreate(
            ['nama_produk' => 'Chocolate Cake'],
            ['harga' => 150000, 'stok' => 10, 'id_kategori' => $kat->id_kategori, 'deskripsi_produk' => 'Kue coklat premium']
        );

        $p2 = Produk::firstOrCreate(
            ['nama_produk' => 'Vanilla Cupcake'],
            ['harga' => 25000, 'stok' => 20, 'id_kategori' => $kat->id_kategori, 'deskripsi_produk' => 'Cupcake lembut']
        );

        $ord1 = Pesanan::create([
            'id_user' => $user1->id,
            'tanggal_pesanan' => '2026-01-01',
            'total_pembayaran' => 400000,
            'metode_pembayaran' => 'Transfer Bank',
            'status_pesanan' => 'menunggu',
            'bukti_pembayaran' => null, 
            'alamat_pengiriman' => 'Jl. Mawar No. 123, Jakarta Raya', 
        ]);

        $ord2 = Pesanan::create([
            'id_user' => $user2->id,
            'tanggal_pesanan' => '2026-01-01',
            'total_pembayaran' => 105000,
            'metode_pembayaran' => 'E-Wallet',
            'status_pesanan' => 'terverifikasi',
            'bukti_pembayaran' => 'bukti_dummy.jpg',
            'alamat_pengiriman' => 'Jl. Melati No. 45, Bandung', 
        ]);

        DetailPesanan::create(['id_pesanan' => $ord1->id_pesanan, 'id_produk' => $p1->id_produk, 'jumlah' => 2, 'subtotal' => 300000]);
        DetailPesanan::create(['id_pesanan' => $ord2->id_pesanan, 'id_produk' => $p2->id_produk, 'jumlah' => 1, 'subtotal' => 25000]);
    }
}