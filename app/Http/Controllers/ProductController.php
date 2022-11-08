<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
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
        Storage::move('public/'.$data['product-cover-photo'], 'public/product-images/'.Str::slug($data['product-name']).'/'.basename($data['product-cover-photo']));
        Product::create([
          'slug' => Str::slug($data['product-name']),
          'name' => $data['product-name'],
          'cover_photo_filename' => basename($data['product-cover-photo']),
          'is_active' => false
        ]);
        return redirect('/admin')->with('success', Lang::get('product added'));
      } catch (\Exception $e) {
        return back()->with('error', Lang::get('product add failed'));
      }
    }

    public function show(Product $product)
    {
      return view('admin.edit', compact('product'));
    }
}
