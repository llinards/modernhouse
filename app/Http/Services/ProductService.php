<?php

namespace App\Http\Services;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\TranslationsProduct;
use Illuminate\Support\Str;

class ProductService
{
  public function __construct(private FileService $fileService) {}

  public function addProduct(StoreProductRequest $request): Product
  {
    $slug = Str::slug($request->input('product-name'));

    return Product::create([
      'slug' => $slug,
      'cover_photo_filename' => basename($request->input('product-cover-photo.0')),
      'cover_video_filename' => $request->has('product-cover-video') ? basename($request->input('product-cover-video.0')) : null,
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
    $slug = $product->slug;

    foreach ($media as $mediaItem) {
      if ($mediaItem !== null) {
        $this->fileService->storeFile($mediaItem, 'product-images/' . $slug);
      }
    }
  }

  public function updateProduct(Product $product, UpdateProductRequest $request): void
  {
    $isPrimaryLocale = app()->getLocale() === config('app.fallback_locale');
    $slug = $isPrimaryLocale ? Str::slug($request->input('product-name')) : $product->slug;

    if ($isPrimaryLocale && $product->slug !== $slug) {
      $this->fileService->moveDirectory('product-images/' . $product->slug, 'product-images/' . $slug);
    }

    $product->update([
      'slug' => $slug,
      'cover_photo_filename' => $request->has('product-cover-photo') ? basename($request->input('product-cover-photo.0')) : $product->cover_photo_filename,
      'cover_video_filename' => $request->has('product-cover-video') ? basename($request->input('product-cover-video.0')) : $product->cover_video_filename,
      'is_active' => $request->has('product-available'),
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
    $this->fileService->destroyDirectory('product-images/' . $product->slug);
    $product->delete();
  }
}
