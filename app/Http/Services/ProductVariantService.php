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
      if ($image !== null) {
        $fileService = new FileService();
        $fileService->storeFile($image, 'product-images/'.$this->productVariant->product->slug.'/'.$this->slug);
        $this->productVariant->productVariantImages()->create([
          'filename' => basename($image)
        ]);
      }
    }
  }

  public function updateProductVariant(object $data): void
  {
    $fileService = new FileService();
    $this->productVariant = $this->getProductVariant($data['id']);
    $this->setSlug(app()->getLocale() === 'lv' ? $data['product-variant-name'] : $this->productVariant->slug);
    $isSlugChanged = $this->productVariant->slug !== $this->slug;
    if ($isSlugChanged && (app()->getLocale() === 'lv')) {
      $fileService->moveDirectory('product-images/'.$this->productVariant->product->slug.'/'.$this->productVariant->slug,
        'product-images/'.$this->productVariant->product->slug.'/'.$this->slug);
    }
    $this->productVariant->update([
      'slug' => $this->slug,
      'price_basic' => $data['product-variant-basic-price'],
      'price_full' => $data['product-variant-full-price'],
      'living_area' => $data['product-variant-living-area'],
      'building_area' => $data['product-variant-building-area'],
      'is_active' => isset($data['product-variant-available']),
    ]);
  }

  public function updateTranslation($translation, $data): void
  {
    $translation->update([
      'name' => $data['product-variant-name'],
      'description' => $data['product-variant-description']
    ]);
  }

  public function destroyProductVariant(object $data): void
  {
    $this->productVariant = $this->getProductVariant($data->id);
    $fileService = new FileService();
    $fileService->destroyDirectory('product-images/'.$this->productVariant->product->slug.'/'.$this->productVariant->slug);
    $this->productVariant->delete();
  }

  public function destroyImage(object $data): void
  {
    $fileService = new FileService();
    $fileService->destroyFile($data->filename,
      'product-images/'.$data->productVariant->product->slug.'/'.$data->productVariant->slug);
    $data->delete();
  }
}
