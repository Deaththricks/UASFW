<?php   
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Carbon\Carbon;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    public function index()
    {
        $pendapatanHari = Pesanan::whereDate('tanggal_pesanan', today())->sum('total_pembayaran');
        $pesananHari = Pesanan::whereDate('tanggal_pesanan', today())->count();

        $pendapatanBulan = Pesanan::whereMonth('tanggal_pesanan', now()->month)->sum('total_pembayaran');
        $pesananBulan = Pesanan::whereMonth('tanggal_pesanan', now()->month)->count();

        $produkTerlaris = DetailPesanan::selectRaw('id_produk, SUM(jumlah) as total_jual')
            ->with('produk')
            ->groupBy('id_produk')
            ->orderByDesc('total_jual')
            ->limit(5)
            ->get();

        $transaksiTerakhir = Pesanan::with('user')
            ->orderByDesc('tanggal_pesanan')
            ->limit(5)
            ->get();

        return view('manager.laporan.index', compact(
            'pendapatanHari','pesananHari',
            'pendapatanBulan','pesananBulan',
            'produkTerlaris','transaksiTerakhir'
        ));
    }

    public function exportExcel()
    {
        return Excel::download(new LaporanExport, 'laporan-penjualan.xlsx');
    }

    public function exportPdf()
    {
        $pesanans = Pesanan::with('user')->get();
        $pdf = PDF::loadView('manager.laporan.pdf', compact('pesanans'));
        return $pdf->download('laporan-penjualan.pdf');
    }
}
