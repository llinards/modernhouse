<?php

namespace App\Http\Services;


use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;

class ProductVariantOptionService
{
  public function storeProductVariantOption(object $data): void
  {
    ProductVariantOption::create([
      'product_variant_id' => $data['id'],
      'option_title'       => $data['product_variant_option'],
      'language'           => app()->getLocale(),
    ]);
  }

  public function updateProductVariantOption(object $data): void
  {
    $productVariantOption = ProductVariantOption::findOrFail($data['id']);
    $productVariantOption->update([
      'option_title' => $data['product_variant_option'],
    ]);
  }

  public function updateProductVariantOptionDetail(object $data): void
  {
    $productVariantOptionDetail = ProductVariantOptionDetail::findOrFail($data['id']);
    $productVariantOptionDetail->update([
      'detail'        => $data['product_variant_option_detail'],
      'has_in_basic'  => isset($data['has_in_basic']),
      'has_in_middle' => isset($data['has_in_middle']),
      'has_in_full'   => isset($data['has_in_full']),
    ]);
  }

  public function destroyProductVariantOption(object $productVariantOption): void
  {
    $productVariantOption->delete();
  }

  public function destroyProductVariantOptionDetail(object $productVariantOptionDetail): void
  {
    $productVariantOptionDetail->delete();
  }

  public function destroyProductVariantOptions(object $productVariant): void
  {
    $productVariant->productVariantOptions()->delete();
  }
}
