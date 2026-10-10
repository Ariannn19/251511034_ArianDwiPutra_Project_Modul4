<?php

namespace App\Http\Controllers;

use App\Models\Product;

class TokoController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $cart = session()->get('cart', []);
        return view('toko', compact('products', 'cart'));
    }
}
