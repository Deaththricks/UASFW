<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\pesanan; 
use App\Models\detailpesanan; 
use Illuminate\Support\Facades\Auth;

class CustomerCartController extends Controller
{
    public function index()
    {
        return view('customer.cart'); 
    }

    public function update(Request $request){
    if($request->id && $request->quantity) {
        $cart = session()->get('cart');
        if(isset($cart[$request->id])) {
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Keranjang diperbarui!');
        }
    }
    return redirect()->back();
    }

    public function remove(Request $request){
    if($request->id) {
        $cart = session()->get('cart');
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
        session()->flash('success', 'Produk dihapus!');
    }
    return redirect()->back(); 
    }

    public function addToCart(Request $request, $id) 
{
    $product = produk::findOrFail($id); 
    $cart = session()->get('cart', []);
    
    $qty = (int) $request->input('quantity', 1);
    if(isset($cart[$id])) {
        $cart[$id]['quantity'] += $qty;
    } else {
        $cart[$id] = [
            "name" => $product->nama_produk,      
            "quantity" => $qty, 
            "price" => $product->harga,                   
            "image" => $product->gambar_produk    
        ];
    }

    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
 

    }

    public function ProcessOrder(Request $request)
{
    // 1. Get the payment method from the radio buttons (named 'method' in your Blade)
    $metode = $request->input('method'); 

    $path = null;

    // 2. Conditional File Upload: Only require file if method is NOT COD
    if ($metode !== 'COD') {
        if (!$request->hasFile('bukti_pembayaran')) {
            return back()->with('error', 'Silahkan upload bukti pembayaran untuk metode ' . $metode);
        }
        $path = $request->file('bukti_pembayaran')->store('payments', 'public');
    }

    // 3. Get Cart Data
    $cart = session()->get('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong!');
    }

    // 4. Calculate Total
    $total = array_reduce($cart, function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    // 5. Create Order with dynamic 'metode_pembayaran' and 'alamat' from form
    $order = \App\Models\pesanan::create([
        'id_user'           => auth()->id(),
        'tanggal_pesanan'    => now()->format('Y-m-d'),
        'total_pembayaran'   => $total,
        'metode_pembayaran'  => $metode, // Use the variable from input
        'status_pesanan'     => 'menunggu',
        'bukti_pembayaran'   => $path, // Will be null for COD
        'alamat_pengiriman'  => $request->input('alamat') ?? (auth()->user()->alamat ?? 'Alamat tidak tersedia'),
    ]);

    // 6. Create Details
    foreach ($cart as $id_produk => $details) {
        \App\Models\detailpesanan::create([
            'id_pesanan' => $order->id_pesanan,
            'id_produk'  => $id_produk,
            'jumlah'     => $details['quantity'],
            'subtotal'   => $details['price'] * $details['quantity'],
        ]);
    }

    session()->forget('cart');
    return redirect()->route('customer.history')->with('success', 'Pesanan berhasil diproses!');
}
}