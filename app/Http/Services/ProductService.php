<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductService
{
  private string $slug;
  private object $product;

  private function setSlug(string $slug): void
  {
    $this->slug = Str::slug($slug);
  }

  private function getProduct(string $id): object
  {
    return Product::findOrFail($id);
  }

  public function getTranslation()
  {
    return $this->product->translations()->where('language', app()->getLocale())->first();
  }

  public function addProduct(object $data): void
  {
    $this->setSlug($data['product-slug']);
    $this->product = Product::create([
      //TODO: delete this
      'name_lv' => 'empty',
      'slug' => $this->slug,
      'cover_photo_filename' => basename($data['product-cover-photo'][0]),
      'is_active' => false
    ]);
  }

  public function addTranslation(object $data): void
  {
    $this->product->translations()->create([
      'name' => $data['product-name'],
      'language' => app()->getLocale()
    ]);
  }

  public function addImage(array $images): void
  {
    foreach ($images as $image) {
      $fileService = new FileService();
      $fileService->storeFile($image, 'product-images/'.$this->slug);
    }
  }

  public function updateProduct(object $data): void
  {
    $fileService = new FileService();
    $this->product = $this->getProduct($data['id']);
    $this->setSlug(app()->getLocale() === 'lv' ? $data['product-slug'] : $this->product->slug);
    $isSlugChanged = $this->product->slug !== $this->slug;
    if ($isSlugChanged && (app()->getLocale() === 'lv')) {
      $fileService->moveDirectory('product-images/'.$this->product->slug, 'product-images/'.$this->slug);
    }
    $this->product->update([
      'slug' => $this->slug,
      'cover_photo_filename' => isset($data['product-cover-photo'][0]) ? basename($data['product-cover-photo'][0]) : $this->product->cover_photo_filename,
      'is_active' => isset($data['product-available'])
    ]);
  }

  public function updateTranslation($translation, $data): void
  {
    $translation->update([
      'name' => $data['product-name'],
    ]);
  }
}
