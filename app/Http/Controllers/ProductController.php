<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\ProductService;
use App\Models\Product;
use App\Models\ProductVariant;
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
    $products = Product::select('id', 'slug', 'cover_photo_filename', 'is_active')
      ->with([
        'translations' => function ($query) {
          $query->select('name', 'product_id', 'language')->where('language', app()->getLocale());
        },
      ])
      ->with([
        'productVariants' => function ($query) {
          $query->select('id', 'product_id', 'slug', 'is_active')->orderBy('slug');
          $query->with([
            'translations' => function ($query) {
              $query->select('product_variant_id', 'name', 'language')->where('language',
                app()->getLocale());
            },
          ]);
        }
      ])
      ->get();
    return view('admin.index', compact('products'));
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
      if ($e->getCode() === '23000') {
        return back()->with('error', 'Kļūda! Šāds nosaukums jau eksistē.');
      }
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function show($language, Product $product)
  {
    $productVariants = ProductVariant::select('id', 'product_id', 'slug', 'price_basic', 'price_full', 'living_area',
      'building_area',
      'price_full')
      ->with([
        'translations' => function ($query) {
          $query->select('product_variant_id', 'name', 'description')->where('language',
            app()->getLocale());
        },
      ])
      ->with([
        'productVariantImages' => function ($query) {
          $query->select('product_variant_id', 'filename');
        },
      ])
      ->with([
        'productVariantDetails' => function ($query) {
          $query->select('product_variant_id', 'name', 'hasThis', 'icon', 'count')->where('language',
            app()->getLocale());
        },
      ])
      ->with([
        'productVariantOptions' => function ($query) {
          $query->select('product_variant_id', 'option_title', 'option_category', 'options')->where('language',
            app()->getLocale());
        },
      ])
      ->whereHas('translations', function ($query) {
        $query->where('language', app()->getLocale());
      })
      ->where('is_active', 1)
      ->where('product_id', $product->id)
      ->orderBy('slug')
      ->get();

    $product = Product::select('id', 'slug')
      ->with([
        'translations' => function ($query) {
          $query->select('name', 'product_id')->where('language', app()->getLocale());
        },
      ])
      ->whereHas('translations', function ($query) {
        $query->where('language', app()->getLocale());
      })
      ->where('is_active', 1)
      ->findOrFail($product->id);
    return view('product', compact('productVariants', 'product'));
  }

  public function showAdmin(Product $product)
  {
    $product = Product::select('id', 'is_active', 'slug', 'cover_photo_filename')
      ->with([
        'translations' => function ($query) {
          $query->select('name', 'product_id', 'language')->where('language', app()->getLocale());
        },
      ])
      ->findOrFail($product->id);
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
      if ($e->getCode() === '23000') {
        return back()->with('error', 'Kļūda! Šāds nosaukums jau eksistē.');
      }
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
