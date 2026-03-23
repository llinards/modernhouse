<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductController extends Controller
{
  public function index(): View
  {
    $allActiveProducts = Product::select('id', 'slug', 'cover_photo_filename', 'cover_video_filename')
                                ->withWhereHas('translations', function ($query) {
                                  $query->select('name', 'product_id', 'language')
                                        ->where('language', app()->getLocale());
                                })
                                ->where('is_active', true)
                                ->orderBy('order')
                                ->get();

    return view('home', compact('allActiveProducts'));
  }

  public function indexAdmin(): View
  {
    return view('admin.index');
  }

  public function create(): View
  {
    return view('admin.product.create');
  }

  public function store(StoreProductRequest $request, ProductService $productService): RedirectResponse
  {
    try {
      return DB::transaction(function () use ($request, $productService) {
        $product = $productService->addProduct($request);
        $productService->addTranslation($product, $request->input('product-name'));
        $productService->addMedia($product, $request->input('product-cover-photo'));

        if ($request->has('product-cover-video')) {
          $productService->addMedia($product, $request->input('product-cover-video'));
        }

        return redirect()->route('admin.products.index', ['locale' => app()->getLocale()])
                         ->with('success', 'Pievienots!');
      });
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function showAdmin(string $locale, Product $product): View
  {
    $product->load(['translations' => function ($query) {
      $query->where('language', app()->getLocale());
    }]);

    return view('admin.product.edit', compact('product'));
  }

  public function update(string $locale, Product $product, UpdateProductRequest $request, ProductService $productService): RedirectResponse
  {
    try {
      return DB::transaction(function () use ($product, $request, $productService) {
        $productService->updateProduct($product, $request);

        $translation = $productService->getTranslation($product);
        if ($translation) {
          $productService->updateTranslation($translation, $request->input('product-name'));
        } else {
          $productService->addTranslation($product, $request->input('product-name'));
        }

        if ($request->has('product-cover-photo')) {
          $productService->addMedia($product, $request->input('product-cover-photo'));
        }
        if ($request->has('product-cover-video')) {
          $productService->addMedia($product, $request->input('product-cover-video'));
        }

        return redirect()->route('admin.products.index', ['locale' => app()->getLocale()])
                         ->with('success', 'Atjaunots!');
      });
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(string $locale, Product $product, ProductService $productService): RedirectResponse
  {
    try {
      $productService->destroyProduct($product);

      return redirect()->route('admin.products.index', ['locale' => app()->getLocale()])
                       ->with('success', 'Dzēsts!');
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroyVideo(string $locale, Product $product, ProductService $productService): RedirectResponse
  {
    try {
      $productService->destroyVideo($product);

      return back()->with('success', 'Video dzēsts!');
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
