@extends('manager.layout')

@section('title', 'Laporan Penjualan')

@section('content')
<h1 class="text-2xl font-bold mb-6">Laporan Penjualan</h1>

<div class="grid grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-2">Hari Ini</h3>
        <p>Pendapatan: Rp {{ number_format($pendapatanHari,0,',','.') }}</p>
        <p>Pesanan: {{ $pesananHari }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold mb-2">Bulan Ini</h3>
        <p>Pendapatan: Rp {{ number_format($pendapatanBulan,0,',','.') }}</p>
        <p>Pesanan: {{ $pesananBulan }}</p>
    </div>
</div>

<h2 class="text-xl font-semibold mb-4">Produk Terlaris</h2>

<table class="w-full bg-white rounded shadow mb-8">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3 text-left">Produk</th>
            <th class="p-3 text-left">Terjual</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($produkTerlaris as $p)
        <tr class="border-t">
            <td class="p-3">{{ $p->nama_produk }}</td>
            <td class="p-3">{{ $p->total_jual }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2 class="text-xl font-semibold mb-4">Transaksi Terakhir</h2>

<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">ID</th>
            <th class="p-3">Pelanggan</th>
            <th class="p-3">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksiTerakhir as $t)
        <tr class="border-t">
            <td class="p-3">#{{ $t->id_pesanan }}</td>
            <td class="p-3">{{ $t->user->nama_lengkap }}</td>
            <td class="p-3">
                Rp {{ number_format($t->total_pembayaran,0,',','.') }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

    