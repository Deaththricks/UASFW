<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:6px; }
    </style>
</head>
<body>

<h2>Laporan Penjualan</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pesanans as $p)
        <tr>
            <td>#{{ $p->id_pesanan }}</td>
            <td>{{ $p->user->nama_lengkap }}</td>
            <td>{{ $p->total_pembayaran }}</td>
            <td>{{ $p->status_pesanan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
