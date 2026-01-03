<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama_kategori', 'deskripsi_kategori']; 

    public function produk()
    {
        return $this->hasMany(produk::class, 'id_kategori');
    }
}
