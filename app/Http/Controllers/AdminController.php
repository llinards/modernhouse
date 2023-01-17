<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AdminController extends Controller
{
  public function index()
  {
    $allProducts = Product::with('productVariants')->get();
    return view('admin.index', compact('allProducts'));
  }
}
