<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    protected $table = 'pesanans';
    protected $primaryKey = 'id_pesanan';
    protected $fillable = ['id_user', 'tanggal_pesanan', 'total_pembayaran', 'metode_pembayaran', 'status_pesanan', 'bukti_pembayaran', 'alamat_pengiriman'];

    public function user()
    {
        return $this->belongsTo(User::class, ('id_user'));
    }

    public function details()
    {
        return $this->hasMany(detailpesanan::class, 'id_pesanan');
    }
}
