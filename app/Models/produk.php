<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = 'produks';
    protected $primaryKey = 'id_produk';
    protected $fillable = ['id_kategori', 'nama_produk', 'deskripsi_produk', 'harga', 'stok', 'gambar_produk'];

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori');
    }
}
