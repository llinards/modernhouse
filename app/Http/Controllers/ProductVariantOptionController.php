<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductVariantOptionsRequest;
use App\Http\Requests\UpdateProductVariantOptionsRequest;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use Illuminate\Http\Request;
use Illuminate\Queue\Events\Looping;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductVariantOptionController extends Controller
{
  public function store(StoreProductVariantOptionsRequest $data)
  {
//    return $data;
    try {
      foreach ($data['product-variant-option-title'] as $key => $productVariantOption) {
        ProductVariantOption::create([
          'option_title' => $data['product-variant-option-title'][$key],
          'options' => $data['product-variant-option-description'][$key],
          'option_category' => $data['product-variant-option-category'][$key],
          'product_variant_id' => $data['product-variant-id'][$key]
        ]);
      }
      return redirect('/admin/product-variant/'.$data['product-variant-id'][0].'/edit')->with('success', Lang::get('added'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }

  public function show(ProductVariant $productVariant)
  {
    $allProductVariantOptions = $productVariant->productVariantOptionsByCategory;
    return view('admin.product-variant.product-variant-options.index', compact('allProductVariantOptions', 'productVariant'));
  }

  public function update(UpdateProductVariantOptionsRequest $allProductVariantOptions)
  {
    try {
      foreach ($allProductVariantOptions['id'] as $key => $productVariantOption) {
        $updatedProductVariantOption = ProductVariantOption::findOrFail($allProductVariantOptions['id'][$key]);
        $updatedProductVariantOption->update([
          'option_title' => $allProductVariantOptions['product-variant-option-title'][$key],
          'options' => $allProductVariantOptions['product-variant-option-description'][$key],
          'option_category' => $allProductVariantOptions['product-variant-option-category'][$key]
        ]);
      }
      return back()->with('success', Lang::get('updated'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }

  public function destroy(ProductVariant $productVariant, ProductVariantOption $productVariantOption)
  {
    try {
      $productVariantOption->delete();
      return back()->with('success', Lang::get('deleted'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }
}
