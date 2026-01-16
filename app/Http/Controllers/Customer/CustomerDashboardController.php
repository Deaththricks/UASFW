<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\produk;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $products = produk::all();
        return view ('customer.CustomerDashboard', compact('products'));
    }

    public function katalog(){
        $products = produk::all();
        return view ('customer.katalog', compact('products'));
    }
    
     
}
