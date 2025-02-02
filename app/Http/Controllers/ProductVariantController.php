<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Http\Services\ProductVariantService;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;

class ProductVariantController extends Controller
{
  public function create()
  {
    $products = Product::select('id')
                       ->with([
                         'translations' => function ($query) {
                           $query->select('name', 'product_id')->where('language', app()->getLocale());
                         },
                       ])
                       ->get();

    return view('admin.product-variant.create', compact('products'));
  }

  public function store(StoreProductVariantRequest $data, ProductVariantService $productVariantService)
  {
    try {
      $productVariantService->addProductVariant($data);
      $productVariantService->addTranslation($data);
      $productVariantService->addImage($data['product-variant-images']);
      if ($data->has(['product-variant-plan'])) {
        $productVariantService->addPlan($data['product-variant-plan']);
      }
      if ($data->has(['product-variant-attachments'])) {
        $productVariantService->addAttachment($data['product-variant-attachments']);
      }

      return redirect('/admin')->with('success', 'Pievienots!');
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function show(ProductVariant $productVariant)
  {
    $product        = $productVariant->product;
    $productVariant = ProductVariant::select('id', 'slug', 'is_active', 'price_basic', 'price_middle', 'price_full',
      'living_area', 'building_area')
                                    ->with([
                                      'translations' => function ($query) {
                                        $query->select('product_variant_id', 'name', 'description',
                                          'language')->where('language',
                                          app()->getLocale());
                                      },
                                    ])
                                    ->with([
                                      'productVariantPlan' => function ($query) {
                                        $query->select('product_variant_id', 'filename')->where('language',
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
      if ($data->has(['product-variant-plan'])) {
        $productVariantService->addPlan($data['product-variant-plan']);
      }
      if ($data->has(['product-variant-images'])) {
        $productVariantService->addImage($data['product-variant-images']);
      }
      if ($data->has(['product-variant-attachments'])) {
        $productVariantService->addAttachment($data['product-variant-attachments']);
      }

      return back()->with('success', 'Atjaunots!');
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
}
