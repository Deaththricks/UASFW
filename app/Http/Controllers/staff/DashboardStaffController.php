<?php

namespace App\Http\Controllers\Staff; 

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class DashboardStaffController extends Controller 
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        $search = $request->get('search'); 
        $query = Pesanan::with(['user', 'details.produk']);

        if ($status) {
            $query->where('status_pesanan', $status);
        }
        if ($search) {
            $query->where(function($q) use ($search) {
                $cleanSearch = str_replace('ORD', '', $search);
                $q->where('id_pesanan', 'LIKE', "%{$cleanSearch}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('nama_lengkap', 'LIKE', "%{$search}%");
                  });
            });
        }

        $pesanans = $query->latest()->get();
        $idTerpilih = $request->segment(3); 
        
        if ($idTerpilih) {
            $pesananTerpilih = Pesanan::with(['user', 'details.produk'])->find($idTerpilih);
        } else {
            $pesananTerpilih = $pesanans->first();
        }

        return view('staff.dashboardstaff', compact('pesanans', 'pesananTerpilih'));
    }

    public function show(Request $request, $id)
    {
        return $this->index($request);
    }

    public function verifikasi($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status_pesanan' => 'terverifikasi']);
        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi!');
    }

    public function cancel($id)
    {
        Pesanan::findOrFail($id)->update(['status_pesanan' => 'dibatalkan']);
        return redirect()->route('staff.dashboard.index', ['status' => 'dibatalkan'])->with('success', 'Pesanan telah dibatalkan.');
    }

    public function proses($id) 
    {
        Pesanan::findOrFail($id)->update(['status_pesanan' => 'diproses']);
        return redirect()->back()->with('success', 'Pesanan sedang diproses!');
    }   
    
    public function selesai($id)
    {
        Pesanan::findOrFail($id)->update(['status_pesanan' => 'selesai']);
        return redirect()->back()->with('success', 'Pesanan telah selesai!');
    }
}