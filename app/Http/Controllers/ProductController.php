<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\ProductService;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
  public function index()
  {
    $allActiveProducts = Product::select('id', 'slug', 'cover_photo_filename')
      ->with([
        'translations' => function ($query) {
          $query->select('name', 'product_id', 'language')->where('language', app()->getLocale());
        },
      ])
      ->whereHas('translations', function ($query) {
        $query->where('language', app()->getLocale());
      })
      ->where('is_active', true)
      ->get();
    return view('home', compact('allActiveProducts'));
  }

  public function indexAdmin()
  {
    $allProducts = Product::select('id', 'slug', 'cover_photo_filename', 'is_active')
      ->with([
        'translations' => function ($query) {
          $query->select('name', 'product_id', 'language')->where('language', app()->getLocale());
        },
      ])
      ->with([
        'productVariants' => function ($query) {
          $query->select('id', 'product_id', 'name_lv', 'name_en', 'name_no', 'name_se', 'is_active')->orderBy('order');
        }
      ])
      ->get();
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
    $productContent = Product::select('id', 'is_active', 'slug', 'cover_photo_filename')
      ->with([
        'translations' => function ($query) {
          $query->select('name', 'product_id', 'language')->where('language', app()->getLocale());
        },
      ])
      ->findOrFail($product->id);
    return view('admin.product.edit')->with('product', $productContent);
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

  public function destroy(Product $product, ProductService $productService)
  {
    try {
      $productService->destroyProduct($product);
      return redirect('/admin')->with('success', 'Dzēsts!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
