<?php

namespace App\Http\Services;


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
}
