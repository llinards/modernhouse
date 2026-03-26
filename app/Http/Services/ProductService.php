<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\TranslationsProduct;
use Illuminate\Support\Str;

class ProductService
{
  public function __construct(private FileService $fileService) {}

  public function addProduct(string $name, string $coverPhotoPath, ?string $coverVideoPath): Product
  {
    $slug = Str::slug($name);

    return Product::create([
      'slug' => $slug,
      'cover_photo_filename' => basename($coverPhotoPath),
      'cover_video_filename' => $coverVideoPath ? basename($coverVideoPath) : null,
      'is_active' => false,
    ]);
  }

  public function addTranslation(Product $product, string $name): void
  {
    $product->translations()->create([
      'name' => $name,
      'language' => app()->getLocale(),
    ]);
  }

  public function getTranslation(Product $product): ?TranslationsProduct
  {
    return $product->translations()->where('language', app()->getLocale())->first();
  }

  public function addMedia(Product $product, array $media): void
  {
    foreach ($media as $mediaItem) {
      if ($mediaItem !== null) {
        $this->fileService->storeFile($mediaItem, 'product-images/' . $product->slug);
      }
    }
  }

  public function updateProduct(Product $product, string $name, ?string $coverPhotoPath, ?string $coverVideoPath, bool $isActive): void
  {
    $isPrimaryLocale = app()->getLocale() === config('app.fallback_locale');
    $slug = $isPrimaryLocale ? Str::slug($name) : $product->slug;

    if ($isPrimaryLocale && $product->slug !== $slug) {
      $this->fileService->moveDirectory('product-images/' . $product->slug, 'product-images/' . $slug);
    }

    $product->update([
      'slug' => $slug,
      'cover_photo_filename' => $coverPhotoPath ? basename($coverPhotoPath) : $product->cover_photo_filename,
      'cover_video_filename' => $coverVideoPath ? basename($coverVideoPath) : $product->cover_video_filename,
      'is_active' => $isActive,
    ]);
  }

  public function updateTranslation(TranslationsProduct $translation, string $name): void
  {
    $translation->update([
      'name' => $name,
    ]);
  }

  public function destroyVideo(Product $product): void
  {
    $this->fileService->destroyFile($product->cover_video_filename, 'product-images/' . $product->slug);
    $product->update(['cover_video_filename' => null]);
  }

  public function destroyProduct(Product $product): void
  {
    $product->delete();
    $this->fileService->destroyDirectory('product-images/' . $product->slug);
  }
}
