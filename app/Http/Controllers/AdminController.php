<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
      $allProducts = Product::all();
//      dd($allProducts);
      return view('admin.index', compact('allProducts'));
    }

    public function createProduct()
    {
      return view('admin.create');
    }

    public function showProduct(Product $product)
    {
      return view('admin.edit', compact('product'));
    }
}
