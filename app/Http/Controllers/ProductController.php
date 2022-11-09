<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
      $allProducts = Product::with('productVariants')->get();
//      dd($allProducts);
      return view('admin.index', compact('allProducts'));
    }

    public function create()
    {
      return view('admin.create');
    }

    public function store(StoreProductRequest $data)
    {
      try {
        Storage::disk('public')->move($data['product-cover-photo'], 'product-images/'.Str::slug($data['product-name']).'/'.basename($data['product-cover-photo']));
        Product::create([
          'slug' => Str::slug($data['product-name']),
          'name' => $data['product-name'],
          'cover_photo_filename' => basename($data['product-cover-photo']),
          'is_active' => false
        ]);
        return redirect('/admin')->with('success', Lang::get('product added'));
      } catch (\Exception $e) {
        return back()->with('error', Lang::get('error try again'));
      }
    }

    public function show(Product $product)
    {
      return view('admin.edit', compact('product'));
    }

    public function update(UpdateProductRequest $data)
    {

      try {
        $productToUpdate = Product::findOrFail($data->id);
        $newProductSlug = Str::slug($data['product-name']);
        if ($productToUpdate->slug !== $newProductSlug) {
          $newProductImageDirectory = 'product-images/'.$newProductSlug;
          Storage::disk('public')->makeDirectory($newProductImageDirectory);
          Storage::disk('public')->move('product-images/'.$productToUpdate->slug, $newProductImageDirectory);
        }
        if (isset($data['product-cover-photo'])) {
          Storage::disk('public')->delete('product-images/'.$productToUpdate->slug.'/'.$productToUpdate->cover_photo_filename);
          Storage::disk('public')->move($data['product-cover-photo'], 'product-images/'.$newProductSlug.'/'.basename($data['product-cover-photo']));
          $productToUpdate->cover_photo_filename = basename($data['product-cover-photo']);
        }
        $productToUpdate->slug = $newProductSlug;
        $productToUpdate->name = $data['product-name'];
        if (isset($data['product-available'])) {
          $productToUpdate->is_active = true;
        } else {
          $productToUpdate->is_active = false;
        }
        $productToUpdate->save();
        return redirect('/admin')->with('success', Lang::get('product updated'));
      } catch (\Exception $e) {
        return back()->with('error', Lang::get('error try again'));
      }
    }
}
