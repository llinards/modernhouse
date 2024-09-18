<?php

namespace App\Http\Controllers;

class ProductVariantOptionController extends Controller
{
  public function index()
  {
    return view('admin.product-variant.product-variant-options.index');
  }

}
