<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;

class DashboardController extends Controller
{
    public function index()
    {
        return view('manager.dashboard', [
            'totalPelanggan' => User::where('role','pelanggan')->count(),
            'totalProduk' => Produk::count(),

            'penjualanBulan' => Pesanan::whereMonth('created_at', now()->month)
                ->where('status_pesanan','selesai')
                ->sum('total_pembayaran'),

            'pendapatanHari' => Pesanan::whereDate('created_at', today())
                ->where('status_pesanan','selesai')
                ->sum('total_pembayaran'),

            'pesananTerbaru' => Pesanan::with('user')
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}