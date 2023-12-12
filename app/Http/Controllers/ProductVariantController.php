<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Http\Services\ProductVariantService;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;

class ProductVariantController extends Controller
{
  //TODO:check why the first paramter is required to be $language
  public function index($language, Product $product)
  {
    $product = Product::select('id', 'slug')
      ->with([
        'productVariants' => function ($query) {
          $query->select('id', 'product_id', 'slug', 'price_basic', 'price_full', 'living_area', 'building_area',
            'price_full')->where('is_active', 1)->orderBy('slug');
          $query->with([
            'translations' => function ($query) {
              $query->select('product_variant_id', 'name', 'description', 'language')->where('language',
                app()->getLocale());
            },
          ]);
          $query->whereHas('translations', function ($query) {
            $query->where('language', app()->getLocale());
          });
        }
      ])
      ->with([
        'translations' => function ($query) {
          $query->select('name', 'product_id', 'language')->where('language', app()->getLocale());
        },
      ])
      ->whereHas('translations', function ($query) {
        $query->where('language', app()->getLocale());
      })
      ->where('is_active', 1)
      ->findOrFail($product->id);
    return view('product')->with('product', $product);
  }

  public function create()
  {
    $allProducts = Product::select('id')
      ->with([
        'translations' => function ($query) {
          $query->select('name', 'product_id', 'language')->where('language', app()->getLocale());
        },
      ])
      ->get();
    return view('admin.product-variant.create', compact('allProducts'));
  }

  public function store(StoreProductVariantRequest $data, ProductVariantService $productVariantService)
  {
    try {
      $productVariantService->addProductVariant($data);
      $productVariantService->addTranslation($data);
      $productVariantService->addImage($data['product-variant-images']);
      return redirect('/admin')->with('success', 'Pievienots!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function show(ProductVariant $productVariant)
  {
    $product = $productVariant->product;
    $productVariant = ProductVariant::select('id', 'slug', 'is_active', 'price_basic', 'price_full',
      'living_area', 'building_area', 'price_full')
      ->with([
        'translations' => function ($query) {
          $query->select('product_variant_id', 'name', 'description', 'language')->where('language',
            app()->getLocale());

        },
      ])
      ->findOrFail($productVariant->id);
    return view('admin.product-variant.edit', compact('productVariant', 'product'));
  }

  public function update(UpdateProductVariantRequest $data, ProductVariantService $productVariantService)
  {
    try {
      $productVariantService->updateProductVariant($data);
      $translation = $productVariantService->getTranslation();
      if ($translation) {
        $productVariantService->updateTranslation($translation, $data);
      } else {
        $productVariantService->addTranslation($data);
      }
      if ($data->has(['product-variant-images'])) {
        $productVariantService->addImage($data['product-variant-images']);
      }
      return redirect('/admin')->with('success', 'Atjaunots!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(ProductVariant $productVariant, ProductVariantService $productVariantService)
  {
    try {
      $productVariantService->destroyProductVariant($productVariant);
      return redirect('/admin')->with('success', 'Dzēsts!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroyImage(Image $image, ProductVariantService $productVariantService)
  {
    try {
      $productVariantService->destroyImage($image);
      return redirect()->to(app('url')->previous()."#product-variant-images")->with('success', 'Bilde dzēsta!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
