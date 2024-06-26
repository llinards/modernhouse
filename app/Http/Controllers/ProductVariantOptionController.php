<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantOptionsRequest;
use App\Http\Requests\UpdateProductVariantOptionsRequest;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use Illuminate\Support\Facades\Log;

class ProductVariantOptionController extends Controller
{
  public function store(StoreProductVariantOptionsRequest $data)
  {
    try {
      foreach ($data['product-variant-option-title'] as $key => $productVariantOption) {
        $this->addDataToDB($data['product-variant-option-title'][$key],
          $data['product-variant-option-description'][$key], $data['product-variant-option-category'][$key],
          $data['product-variant-id'][$key]);
      }
      return back()->with('success', 'Pievienots!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function show(ProductVariant $productVariant)
  {
    $allProductVariantOptions = $productVariant->productVariantOptionsByCategory->where('language', app()->getLocale());
    return view('admin.product-variant.product-variant-options.index',
      compact('allProductVariantOptions', 'productVariant'));
  }

  public function update(UpdateProductVariantOptionsRequest $allProductVariantOptions)
  {
    try {
      foreach ($allProductVariantOptions['product-variant-id'] as $key => $productVariantOption) {
        if (isset($allProductVariantOptions['id'][$key])) {
          $updatedProductVariantOption = ProductVariantOption::find($allProductVariantOptions['id'][$key]);
          $updatedProductVariantOption->update([
            'option_title' => $allProductVariantOptions['product-variant-option-title'][$key],
            'options' => $allProductVariantOptions['product-variant-option-description'][$key],
            'option_category' => $allProductVariantOptions['product-variant-option-category'][$key]
          ]);
        } else {
          $this->addDataToDB($allProductVariantOptions['product-variant-option-title'][$key],
            $allProductVariantOptions['product-variant-option-description'][$key],
            $allProductVariantOptions['product-variant-option-category'][$key],
            $allProductVariantOptions['product-variant-id'][$key]);
        }
      }
      return back()->with('success', 'Atjaunots!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(ProductVariant $productVariant, ProductVariantOption $productVariantOption)
  {
    try {
      $productVariantOption->delete();
      return back()->with('success', 'Dzēsts!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  protected function addDataToDB(
    $productVariantOptionTitle,
    $productVariantOptionDescription,
    $productVariantOptionCategory,
    $productVariantId
  ) {
    return ProductVariantOption::create([
      'option_title' => $productVariantOptionTitle,
      'options' => $productVariantOptionDescription,
      'option_category' => $productVariantOptionCategory,
      'product_variant_id' => $productVariantId,
      'language' => app()->getLocale(),
    ]);
  }
}
