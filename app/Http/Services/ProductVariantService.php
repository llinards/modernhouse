<?php

namespace App\Http\Services;

use App\Models\ProductVariant;
use Illuminate\Support\Str;

class ProductVariantService
{
  private string $slug;
  private object $productVariant;

  private function setSlug(string $slug): void
  {
    $this->slug = Str::slug($slug);
  }

  private function getProductVariant(string $id): object
  {
    return ProductVariant::findOrFail($id);
  }

  public function getTranslation()
  {
    return $this->productVariant->translations()->where('language', app()->getLocale())->first();
  }

  public function addProductVariant(object $data): void
  {
    $this->setSlug($data['product-variant-name']);
    $this->productVariant = ProductVariant::create([
      'slug' => $this->slug,
      'price_basic' => $data['product-variant-basic-price'],
      'price_full' => $data['product-variant-full-price'],
      'product_id' => $data['product-id'],
      'living_area' => $data['product-variant-living-area'],
      'building_area' => $data['product-variant-building-area'],
      'is_active' => false,
      //delete this
      'name_'.app()->getLocale() => 'empty',
      'description_'.app()->getLocale() => 'empty'
    ]);
  }

  public function addTranslation(object $data): void
  {
    $this->productVariant->translations()->create([
      'name' => $data['product-variant-name'],
      'description' => $data['product-variant-description'],
      'language' => app()->getLocale()
    ]);
  }

  public function addImage(array $images): void
  {
    foreach ($images as $image) {
      $fileService = new FileService();
      $fileService->storeFile($image, 'product-images/'.$this->productVariant->product->slug.'/'.$this->slug);
      $this->productVariant->productVariantImages()->create([
        'filename' => basename($image)
      ]);
    }
  }
}
