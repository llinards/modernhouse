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
      'slug'                 => $this->slug,
      'cover_photo_filename' => basename($data['product-cover-photo'][0]),
      'cover_video_filename' => isset($data['product-cover-video'][0]) ? basename($data['product-cover-video'][0]) : null,
      'is_active'            => false,
    ]);
  }

  public function addTranslation(object $data): void
  {
    $this->product->translations()->create([
      'name'     => $data['product-name'],
      'language' => app()->getLocale(),
    ]);
  }

  public function addMedia(array $media): void
  {
    foreach ($media as $mediaItem) {
      if ($mediaItem !== null) {
        $fileService = new FileService();
        $fileService->storeFile($mediaItem, 'product-images/'.$this->slug);
      }
    }
  }

  public function updateProduct(object $data): void
  {
    $fileService   = new FileService();
    $this->product = $this->getProduct($data['id']);
    $this->setSlug($data['product-slug']);
    $isSlugChanged = $this->product->slug !== $this->slug;
    if ($isSlugChanged) {
      $fileService->moveDirectory('product-images/'.$this->product->slug, 'product-images/'.$this->slug);
    }
    $this->product->update([
      'slug'                 => $this->slug,
      'cover_photo_filename' => isset($data['product-cover-photo'][0]) ? basename($data['product-cover-photo'][0]) : $this->product->cover_photo_filename,
      'cover_video_filename' => isset($data['product-cover-video'][0]) ? basename($data['product-cover-video'][0]) : $this->product->cover_video_filename,
      'is_active'            => isset($data['product-available']),
    ]);
  }

  public function updateTranslation($translation, $data): void
  {
    $translation->update([
      'name' => $data['product-name'],
    ]);
  }

  public function destroyVideo(object $data): void
  {
    $this->product = $this->getProduct($data->id);
    $fileService   = new FileService();
    $fileService->destroyFile($this->product->cover_video_filename, 'product-images/'.$this->product->slug);
    $this->product->update(['cover_video_filename' => null]);
  }

  public function destroyProduct(object $data): void
  {
    $this->product = $this->getProduct($data->id);
    $fileService   = new FileService();
    $fileService->destroyDirectory('product-images/'.$this->product->slug);
    $this->product->delete();
  }
}
