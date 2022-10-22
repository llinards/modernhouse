<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductInfoRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

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

    public function requestProductInfo(ProductInfoRequest $request)
    {

      return back()->with('success', Lang::get('message has been sent'));
    }
}
