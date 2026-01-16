@extends('manager.layout')
@section('title','Laporan Penjualan')

@section('content')
<h1 class="text-2xl font-bold mb-6">Laporan Penjualan</h1>

<div class="grid grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold">Hari Ini</h3>
        <p>Pendapatan: Rp {{ number_format($pendapatanHari,0,',','.') }}</p>
        <p>Pesanan: {{ $pesananHari }}</p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold">Bulan Ini</h3>
        <p>Pendapatan: Rp {{ number_format($pendapatanBulan,0,',','.') }}</p>
        <p>Pesanan: {{ $pesananBulan }}</p>
    </div>
</div>

<div class="flex gap-4 mb-6">
    <a href="{{ route('manager.laporan.excel') }}" class="bg-green-500 text-white px-4 py-2 rounded">
        Download Excel
    </a>
    <a href="{{ route('manager.laporan.pdf') }}" class="bg-red-500 text-white px-4 py-2 rounded">
        Download PDF
    </a>
</div>

<div class="bg-white p-6 rounded shadow mb-6">
    <canvas id="chartProduk"></canvas>
</div>

<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">ID</th>
            <th class="p-3">Pelanggan</th>
            <th class="p-3">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksiTerakhir as $t)
        <tr class="border-t">
            <td class="p-3">#{{ $t->id_pesanan }}</td>
            <td class="p-3">{{ $t->user->nama_lengkap }}</td>
            <td class="p-3">Rp {{ number_format($t->total_pembayaran,0,',','.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
const ctx = document.getElementById('chartProduk');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($produkTerlaris->pluck('produk.nama_produk')) !!},
        datasets: [{
            label: 'Produk Terlaris',
            data: {!! json_encode($produkTerlaris->pluck('total_jual')) !!}
        }]
    }
});
</script>
@endsection
