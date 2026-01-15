<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pesanan::with('user')
            ->select('id_pesanan', 'id_user', 'total_pembayaran', 'status_pesanan', 'created_at')
            ->get()
            ->map(function ($p) {
                return [
                    'ID Pesanan' => $p->id_pesanan,
                    'Pelanggan' => $p->user->nama_lengkap ?? '-',
                    'Total Bayar' => $p->total_pembayaran,
                    'Status' => $p->status_pesanan,
                    'Tanggal' => $p->created_at->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID Pesanan',
            'Pelanggan',
            'Total Bayar',
            'Status',
            'Tanggal',
        ];
    }
}
