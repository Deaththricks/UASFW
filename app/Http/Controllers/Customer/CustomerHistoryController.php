<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerHistoryController extends Controller{
    public function index() {
    $orders = \App\Models\pesanan::with(['details.produk']) // This loads the nested product data
                ->where('id_user', auth()->id())
                ->orderBy('tanggal_pesanan', 'desc')
                ->get();

    return view('customer.history', compact('orders'));
}
}
