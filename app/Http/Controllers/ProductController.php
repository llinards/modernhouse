<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\ProductService;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

  public function update(UpdateProductRequest $data, ProductService $productService)
  {
    try {
      $productService->updateProduct($data);
      $translation = $productService->getTranslation();
      if ($translation) {
        $productService->updateTranslation($translation, $data);
      } else {
        $productService->addTranslation($data);
      }
      if ($data->has(['product-cover-photo'])) {
        $productService->addImage($data['product-cover-photo']);
      }
      return redirect('/admin')->with('success', 'Atjaunots!');
    } catch (\Exception $e) {
      Log::error($e);
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
