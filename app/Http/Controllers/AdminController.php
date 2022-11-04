<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminIndex()
    {
      $allProducts = Product::all();
//      dd($allProducts);
      return view('admin.index', compact('allProducts'));
    }

    public function adminShow(Product $product)
    {
      return view('admin.edit', compact('product'));
    }
}
