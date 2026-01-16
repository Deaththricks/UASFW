@extends('manager.layout')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-4 gap-6 mb-8">

    <!-- Total Pelanggan -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-5 rounded-xl shadow">
        <p class="text-sm opacity-90">Total Pelanggan</p>
        <h2 class="text-3xl font-bold mt-2">{{ $totalPelanggan }}</h2>
    </div>

    <!-- Total Produk -->
    <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-5 rounded-xl shadow">
        <p class="text-sm opacity-90">Total Produk</p>
        <h2 class="text-3xl font-bold mt-2">{{ $totalProduk }}</h2>
    </div>

    <!-- Penjualan Bulan Ini -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-5 rounded-xl shadow">
        <p class="text-sm opacity-90">Penjualan Bulan Ini</p>
        <h2 class="text-2xl font-bold mt-2">
            Rp {{ number_format($penjualanBulan,0,',','.') }}
        </h2>
    </div>

    <!-- Pendapatan Hari Ini -->
    <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white p-5 rounded-xl shadow">
        <p class="text-sm opacity-90">Pendapatan Hari Ini</p>
        <h2 class="text-2xl font-bold mt-2">
            Rp {{ number_format($pendapatanHari,0,',','.') }}
        </h2>
    </div>

</div>


<h2 class="text-xl font-semibold mb-4">Pesanan Terbaru</h2>

<table class="w-full bg-white rounded shadow">
    <thead class="bg-[#e8b44a]">
        <tr>
            <th class="p-3 text-left">ID</th>
            <th class="p-3 text-left">Pelanggan</th>
            <th class="p-3 text-left">Total</th>
            <th class="p-3 text-left">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pesananTerbaru as $p)
        <tr class="border-t">
            <td class="p-3">#{{ $p->id_pesanan }}</td>
            <td class="p-3">{{ $p->user->nama_lengkap }}</td>
            <td class="p-3">
                Rp {{ number_format($p->total_pembayaran,0,',','.') }}
            </td>
            <td class="p-3 capitalize">{{ $p->status_pesanan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
    
