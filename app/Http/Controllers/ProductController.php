<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
  public function index()
  {
    $allProducts = Product::with('productVariants')->get();
    return view('admin.index', compact('allProducts'));
  }

  public function create()
  {
    return view('admin.product.create');
  }

  public function store(StoreProductRequest $data)
  {
    try {
      $productCoverPhotoFilename = basename($data['product-cover-photo']);
      $productSlug = Str::slug($data['product-name']);

      Storage::disk('public')->move($data['product-cover-photo'], 'product-images/' . $productSlug . '/' . $productCoverPhotoFilename);
      Product::create([
        'slug' => $productSlug,
        'name' => $data['product-name'],
        'cover_photo_filename' => $productCoverPhotoFilename,
        'is_active' => false
      ]);
      return redirect('/admin')->with('success', Lang::get('added'));
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', Lang::get('error try again'));
    }
  }

  public function show(Product $product)
  {
    return view('admin.product.edit', compact('product'));
  }

  public function update(UpdateProductRequest $data)
  {
    try {
      $productToUpdate = Product::findOrFail($data->id);
      $newProductSlug = Str::slug($data['product-name']);
      if ($productToUpdate->slug !== $newProductSlug) {
        $newProductImageDirectory = 'product-images/' . $newProductSlug;
        Storage::disk('public')->makeDirectory($newProductImageDirectory);
        Storage::disk('public')->move('product-images/' . $productToUpdate->slug, $newProductImageDirectory);
      }
      if (isset($data['product-cover-photo'])) {
        Storage::disk('public')->delete('product-images/' . $productToUpdate->slug . '/' . $productToUpdate->cover_photo_filename);
        Storage::disk('public')->move($data['product-cover-photo'], 'product-images/' . $newProductSlug . '/' . basename($data['product-cover-photo']));
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
      return redirect('/admin')->with('success', Lang::get('updated'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }

  public function destroy(Product $product)
  {
    try {
      Storage::disk('public')->deleteDirectory('product-images/' . $product->slug);
      $product->delete();
      return redirect('/admin')->with('success', Lang::get('deleted'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }
}
