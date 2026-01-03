<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_user')->constrained('users', 'id');
            $table->date('tanggal_pesanan');
            $table->decimal('total_pembayaran', 15, 2);
            $table->string('metode_pembayaran');
            $table->enum('status_pesanan', ['pending', 'dibayar', 'dikirim', 'selesai', 'dibatalkan']);
            $table->string('bukti_pembayaran')->nullable();
            $table->text('alamat_pengiriman');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
