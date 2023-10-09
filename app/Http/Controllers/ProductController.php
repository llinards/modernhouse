<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\ProductService;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
  public function index()
  {
    $allProducts = Product::all();
    return view('admin.index', compact('allProducts'));
  }

  public function create()
  {
    return view('admin.product.create');
  }

  public function store(StoreProductRequest $data, ProductService $productService)
  {
    try {
      $productService->addProduct($data);
      $productService->addTranslation($data);
      $productService->addImage($data['product-cover-photo']);
      return redirect('/admin')->with('success', 'Pievienots!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
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
      $productSlug = app()->getLocale() === 'lv' ? Str::slug($data['product-slug']) : $productToUpdate->slug;

      if ((app()->getLocale() === 'lv') && $productToUpdate->slug !== $productSlug) {
        $newProductImageDirectory = 'product-images/'.$productSlug;
        Storage::disk('public')->makeDirectory($newProductImageDirectory);
        Storage::disk('public')->move('product-images/'.$productToUpdate->slug, $newProductImageDirectory);
      }

      if (isset($data['product-cover-photo'])) {
        $productCoverPhotoFilename = "";
        Storage::disk('public')->delete('product-images/'.$productToUpdate->slug.'/'.$productToUpdate->cover_photo_filename);
        foreach ($data['product-cover-photo'] as $image) {
          $productCoverPhotoFilename = basename($image);
          Storage::disk('public')->move($image,
            'product-images/'.$productSlug.'/'.$productCoverPhotoFilename);
        }
        $productToUpdate->cover_photo_filename = $productCoverPhotoFilename;
      }

      $productToUpdate->slug = $productSlug;
      $productToUpdate->{'name_'.app()->getLocale()} = $data['product-name'];

      if (isset($data['product-available'])) {
        $productToUpdate->is_active = true;
      } else {
        $productToUpdate->is_active = false;
      }
      $productToUpdate->save();
      return redirect('/admin')->with('success', 'Atjaunots!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(Product $product)
  {
    try {
      Storage::disk('public')->deleteDirectory('product-images/'.$product->slug);
      $product->delete();
      return redirect('/admin')->with('success', 'Dzēsts!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
