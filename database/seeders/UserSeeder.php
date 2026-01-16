<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['user_name' => 'manager10'],
            [
                'email' => 'manager@mail.com',
                'password' => Hash::make('password'),
                'nama_lengkap' => 'Manager Utama',
                'alamat' => 'Kantor Pusat',
                'no_hp' => '081234567890',
                'role' => 'manager',
                'status' => 1
            ]
        );

        User::firstOrCreate(
            ['user_name' => 'staff10'],
            [
                'email' => 'staff@mail.com',
                'password' => Hash::make('password'),
                'nama_lengkap' => 'Staff Operasional',
                'alamat' => 'Gudang',
                'no_hp' => '081234567891',
                'role' => 'staff',
                'status' => 1
            ]
        );

        User::firstOrCreate(
            ['user_name' => 'pelanggan10'],
            [
                'email' => 'pelanggan@mail.com',
                'password' => Hash::make('password'),
                'nama_lengkap' => 'Pelanggan Umum',
                'alamat' => 'Rumah Pelanggan',
                'no_hp' => '081234567892',
                'role' => 'pelanggan',
                'status' => 1
            ]
        );
    }
}
