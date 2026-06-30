<?php

namespace App\Http\Services;


use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;

class ProductVariantOptionService
{
  public function storeProductVariantOption(ProductVariant $productVariant, string $title): void
  {
    $maxOrder = ProductVariantOption::withoutGlobalScope('order')
                                    ->where('product_variant_id', $productVariant->id)
                                    ->where('language', app()->getLocale())
                                    ->max('order');

    ProductVariantOption::create([
      'product_variant_id' => $productVariant->id,
      'option_title'       => $title,
      'language'           => app()->getLocale(),
      'order'              => $maxOrder !== null ? $maxOrder + 1 : 0,
    ]);
  }

  /**
   * @param  array{detail: string, is_label?: bool, has_in_basic?: bool, has_in_middle?: bool, has_in_full?: bool} $data
   */
  public function storeProductVariantOptionDetail(ProductVariantOption $productVariantOption, array $data): void
  {
    $maxOrder = ProductVariantOptionDetail::withoutGlobalScope('order')
                                          ->where('product_variant_option_id', $productVariantOption->id)
                                          ->max('order');

    ProductVariantOptionDetail::create([
      'product_variant_option_id' => $productVariantOption->id,
      'detail'                    => $data['detail'],
      'is_label'                  => $data['is_label'] ?? false,
      'has_in_basic'              => $data['has_in_basic'] ?? false,
      'has_in_middle'             => $data['has_in_middle'] ?? false,
      'has_in_full'               => $data['has_in_full'] ?? false,
      'order'                     => $maxOrder !== null ? $maxOrder + 1 : 0,
    ]);
  }

  public function updateProductVariantOption(ProductVariantOption $productVariantOption, string $title): void
  {
    $productVariantOption->update([
      'option_title' => $title,
    ]);
  }

  /**
   * @param  array{detail: string, is_label?: bool, has_in_basic?: bool, has_in_middle?: bool, has_in_full?: bool} $data
   */
  public function updateProductVariantOptionDetail(ProductVariantOptionDetail $productVariantOptionDetail, array $data): void
  {
    $productVariantOptionDetail->update([
      'detail'        => $data['detail'],
      'is_label'      => $data['is_label'] ?? false,
      'has_in_basic'  => $data['has_in_basic'] ?? false,
      'has_in_middle' => $data['has_in_middle'] ?? false,
      'has_in_full'   => $data['has_in_full'] ?? false,
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
          'is_label'                  => $detail->is_label,
          'has_in_basic'              => $detail->has_in_basic,
          'has_in_middle'             => $detail->has_in_middle,
          'has_in_full'               => $detail->has_in_full,
          'order'                     => $detail->order,
        ]);
      }
    }
  }
}
