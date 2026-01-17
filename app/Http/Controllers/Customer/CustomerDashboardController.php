<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\produk;
use App\Models\kategori; 
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    /**
     * Display the main dashboard with search and category filters.
     */
    public function index(Request $request)
    {
        // 1. Fetch all categories for the filter buttons in the view
        $categories = kategori::all(); 

        // 2. Initialize the query on the 'produk' model
        $query = produk::query();

        // 3. Handle SEARCH logic
        // Checks if 'search' input is present and not empty
        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // 4. Handle CATEGORY filter logic
        // Matches the 'id_kategori' field in your produk model
        if ($request->has('category') && $request->category != 'all') {
            $query->where('id_kategori', $request->category);
        }
        
        // 5. Execute query with pagination
        // appends($request->all()) is CRITICAL so search results don't disappear on Page 2
        $products = $query->paginate(12)->appends($request->all());

        // 6. Return the view with the data
        return view('customer.CustomerDashboard', compact('products', 'categories'));
    }

    /**
     * Display a specific product detail page.
     */
    public function ProductShow($id)
    {
        // Find product by id_produk (as defined in your model's $primaryKey)
        $product = produk::findOrFail($id);
        
        return view('customer.productShow', compact('product'));
    }
}