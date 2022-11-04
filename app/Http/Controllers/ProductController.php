<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
      $allProducts = Product::all();
//      dd($allProducts);
      return view('admin.index', compact('allProducts'));
    }

    public function create()
    {
      return view('admin.create');
    }

    public function store(ProductRequest $data)
    {
      try {
        Product::create([
          'slug' => Str::slug($data['product-name']),
          'name' => $data['product-name'],
          'cover' => $data['product-cover-photo']
        ]);
        return redirect('/admin')->with('success', Lang::get('product added'));
      } catch (\Exception $e) {
        return back()->with('error', $e);
        return back()->with('error', Lang::get('product add failed'));
      }
    }

    public function show(Product $product)
    {
      return view('admin.edit', compact('product'));
    }
}
