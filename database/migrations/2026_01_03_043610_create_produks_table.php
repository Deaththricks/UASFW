<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id('id_produk');
            $table->foreignId('id_kategori')->constrained('kategoris', 'id_kategori');
            $table->string('nama_produk');
            $table->text('deskripsi_produk');
            $table->decimal('harga', 12, 2);
            $table->integer('stok');
            $table->string('gambar_produk')->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
