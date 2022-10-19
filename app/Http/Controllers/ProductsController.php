<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
      $allProducts = Product::all();
      return view('home', compact('allProducts'));
    }

    public function show(Product $product)
    {
      return view('product', compact('product'));
    }

    public function requestProductInfo(Request $request)
    {
      
    }
}
