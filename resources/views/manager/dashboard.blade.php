@extends('manager.layout')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Total Pelanggan</p>
        <h2 class="text-2xl font-bold">{{ $totalPelanggan }}</h2>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Total Produk</p>
        <h2 class="text-2xl font-bold">{{ $totalProduk }}</h2>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Penjualan Bulan Ini</p>
        <h2 class="text-2xl font-bold">
            Rp {{ number_format($penjualanBulan,0,',','.') }}
        </h2>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Pendapatan Hari Ini</p>
        <h2 class="text-2xl font-bold">
            Rp {{ number_format($pendapatanHari,0,',','.') }}
        </h2>
    </div>
</div>

<h2 class="text-xl font-semibold mb-4">Pesanan Terbaru</h2>

<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-200">
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
    
