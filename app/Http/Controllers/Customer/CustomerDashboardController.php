<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\produk;
use App\Models\kategori; 
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
   
    public function index(Request $request)
    {
        $categories = kategori::all(); 
        $query = produk::query();

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }
        if ($request->has('category') && $request->category != 'all') {
            $query->where('id_kategori', $request->category);
        }
        
        $products = $query->paginate(12)->appends($request->all());

        return view('customer.CustomerDashboard', compact('products', 'categories'));
    }

 
    public function ProductShow($id)
    {
   
        $product = produk::findOrFail($id);
        
        return view('customer.productShow', compact('product'));
    }
}