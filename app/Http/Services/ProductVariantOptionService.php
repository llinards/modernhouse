<?php

namespace App\Http\Services;


use App\Models\ProductVariantOptionDetail;

class ProductVariantOptionService
{

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
}
