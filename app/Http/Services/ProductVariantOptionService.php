<?php

namespace App\Http\Services;


use App\Http\Requests\ProductVariantOptionDetailRequest;
use App\Http\Requests\ProductVariantOptionRequest;
use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;

class ProductVariantOptionService
{
  public function storeProductVariantOption(ProductVariantOptionRequest $request): void
  {
    $maxOrder = ProductVariantOption::withoutGlobalScope('order')
                                    ->where('product_variant_id', $request->input('id'))
                                    ->where('language', app()->getLocale())
                                    ->max('order');

    ProductVariantOption::create([
      'product_variant_id' => $request->input('id'),
      'option_title'       => $request->input('product_variant_option'),
      'language'           => app()->getLocale(),
      'order'              => $maxOrder !== null ? $maxOrder + 1 : 0,
    ]);
  }

  public function storeProductVariantOptionDetail(ProductVariantOptionDetailRequest $request): void
  {
    $maxOrder = ProductVariantOptionDetail::withoutGlobalScope('order')
                                          ->where('product_variant_option_id', $request->input('id'))
                                          ->max('order');

    ProductVariantOptionDetail::create([
      'product_variant_option_id' => $request->input('id'),
      'detail'                    => $request->input('product_variant_option_detail'),
      'has_in_basic'              => $request->boolean('has_in_basic'),
      'has_in_middle'             => $request->boolean('has_in_middle'),
      'has_in_full'               => $request->boolean('has_in_full'),
      'order'                     => $maxOrder !== null ? $maxOrder + 1 : 0,
    ]);
  }

  public function updateProductVariantOption(ProductVariantOptionRequest $request): void
  {
    $productVariantOption = ProductVariantOption::findOrFail($request->input('id'));
    $productVariantOption->update([
      'option_title' => $request->input('product_variant_option'),
    ]);
  }

  public function updateProductVariantOptionDetail(ProductVariantOptionDetailRequest $request): void
  {
    $productVariantOptionDetail = ProductVariantOptionDetail::findOrFail($request->input('id'));
    $productVariantOptionDetail->update([
      'detail'        => $request->input('product_variant_option_detail'),
      'has_in_basic'  => $request->boolean('has_in_basic'),
      'has_in_middle' => $request->boolean('has_in_middle'),
      'has_in_full'   => $request->boolean('has_in_full'),
    ]);
  }

  public function destroyProductVariantOption(ProductVariantOption $productVariantOption): void
  {
    $productVariantOption->delete();
  }

  public function destroyProductVariantOptionDetail(ProductVariantOptionDetail $productVariantOptionDetail): void
  {
    $productVariantOptionDetail->delete();
  }

  public function destroyProductVariantOptions(ProductVariant $productVariant): void
  {
    $productVariant->productVariantOptions()->delete();
  }

  public function copyFromVariant(ProductVariant $source, ProductVariant $target, string $language): void
  {
    $maxOrder = ProductVariantOption::withoutGlobalScope('order')
                                    ->where('product_variant_id', $target->id)
                                    ->where('language', $language)
                                    ->max('order');

    $nextOrder = $maxOrder !== null ? $maxOrder + 1 : 0;

    $sourceOptions = ProductVariantOption::where('product_variant_id', $source->id)
                                         ->where('language', $language)
                                         ->with('productVariantOptionDetails')
                                         ->get();

    foreach ($sourceOptions as $option) {
      $newOption = ProductVariantOption::create([
        'option_title'       => $option->option_title,
        'product_variant_id' => $target->id,
        'language'           => $language,
        'order'              => $nextOrder++,
      ]);

      foreach ($option->productVariantOptionDetails as $detail) {
        ProductVariantOptionDetail::create([
          'product_variant_option_id' => $newOption->id,
          'detail'                    => $detail->detail,
          'has_in_basic'              => $detail->has_in_basic,
          'has_in_middle'             => $detail->has_in_middle,
          'has_in_full'               => $detail->has_in_full,
          'order'                     => $detail->order,
        ]);
      }
    }
  }
}
