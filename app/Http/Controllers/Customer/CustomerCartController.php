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
    public function cartIndex()
    {
        $cart = session()->get('cart', []);
        return view('customer.cart', compact('cart'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = produk::where('id_produk', $id)->firstOrFail();
        $cart = session()->get('cart', []);
        $qtyToAdd = max(1, (int)$request->quantity);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $qtyToAdd;
        } else {
            // WE MUST USE 'price' TO MATCH THE VIEW
            $cart[$id] = [
                "name"     => $product->nama_produk,
                "quantity" => $qtyToAdd,
                "price"    => $product->harga_produk, 
                "image"    => $product->gambar_produk
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int)$request->quantity);
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'method' => 'required',
            'alamat' => 'required',
        ]);

        $cart = session()->get('cart');
        if (!$cart) return redirect()->back();

        $total = 0;
        foreach ($cart as $details) {
            $total += ($details['price'] ?? 0) * $details['quantity'];
        }

        // CAPTURE THE INTERACTIVE BANK FORM DATA
        $payment_note = null;
        if ($request->method == 'Transfer') {
            $payment_note = "Bank: {$request->bank_user} | Rek: {$request->norek_user} | A/N: {$request->nama_user}";
        }

        $order = pesanan::create([
            'id_user'           => Auth::id() ?? 1, 
            'tanggal_pesanan'   => $request->tgl ?? now(),
            'total_pembayaran'  => $total,
            'metode_pembayaran' => $request->method,
            'status_pesanan'    => 'menunggu', 
            'alamat_pengiriman' => $request->alamat,
            'catatan'           => $payment_note, 
        ]);

        foreach ($cart as $id => $details) {
            detailpesanan::create([
                'id_pesanan' => $order->id_pesanan,
                'id_produk'  => $id,
                'jumlah'     => $details['quantity'],
                'subtotal'   => ($details['price'] ?? 0) * $details['quantity'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('main.dashboard')->with('success_order', 'Berhasil!');
    }
}