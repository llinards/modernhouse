<?php

namespace App\Http\Services;

use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Models\ProductVariant;
use App\Models\TranslationsProductVariants;
use Illuminate\Support\Str;

class ProductVariantService
{
  public function __construct(private FileService $fileService) {}

  public function addProductVariant(StoreProductVariantRequest $request): ProductVariant
  {
    $slug = Str::slug($request->input('product-variant-name'));

    return ProductVariant::create([
      'slug'          => $slug,
      'price_basic'   => $request->input('product-variant-basic-price'),
      'price_middle'  => $request->input('product-variant-middle-price'),
      'price_full'    => $request->input('product-variant-full-price'),
      'product_id'    => $request->input('product-id'),
      'living_area'   => $request->input('product-variant-living-area'),
      'building_area' => $request->input('product-variant-building-area'),
      'is_active'     => false,
    ]);
  }

  public function addTranslation(ProductVariant $productVariant, string $name, string $description): void
  {
    $productVariant->translations()->create([
      'name'        => $name,
      'description' => $description,
      'language'    => app()->getLocale(),
    ]);
  }

  public function getTranslation(ProductVariant $productVariant): ?TranslationsProductVariants
  {
    return $productVariant->translations()->where('language', app()->getLocale())->first();
  }

  public function addImage(ProductVariant $productVariant, array $images): void
  {
    $basePath = 'product-images/' . $productVariant->product->slug . '/' . $productVariant->slug;

    foreach ($images as $index => $image) {
      if ($image !== null) {
        $this->fileService->storeFile($image, $basePath);
        $productVariant->productVariantImages()->create([
          'filename' => basename($image),
          'order'    => $index,
        ]);
      }
    }
  }

  public function addPlan(ProductVariant $productVariant, array $files): void
  {
    $basePath = 'product-images/' . $productVariant->product->slug . '/' . $productVariant->slug . '/plan';

    foreach ($files as $index => $file) {
      if ($file !== null) {
        $this->fileService->storeFile($file, $basePath);
        $productVariant->productVariantPlan()->create([
          'filename' => basename($file),
          'language' => app()->getLocale(),
          'order'    => $index,
        ]);
      }
    }
  }

  public function addAttachment(ProductVariant $productVariant, array $attachments): void
  {
    $basePath = 'product-images/' . $productVariant->product->slug . '/' . $productVariant->slug;

    foreach ($attachments as $attachment) {
      if ($attachment !== null) {
        $existingAttachment = $productVariant->productVariantAttachments()
                                             ->where('language', app()->getLocale())
                                             ->first();
        if ($existingAttachment) {
          $this->fileService->destroyFile($existingAttachment->filename, $basePath);
          $existingAttachment->update([
            'filename' => basename($attachment),
          ]);
        } else {
          $productVariant->productVariantAttachments()->create([
            'filename' => basename($attachment),
            'language' => app()->getLocale(),
          ]);
        }
        $this->fileService->storeFile($attachment, $basePath);
      }
    }
  }

  public function updateProductVariant(ProductVariant $productVariant, UpdateProductVariantRequest $request): void
  {
    $isPrimaryLocale = app()->getLocale() === config('app.fallback_locale');
    $slug = $isPrimaryLocale ? Str::slug($request->input('product-variant-name')) : $productVariant->slug;

    if ($isPrimaryLocale && $productVariant->slug !== $slug) {
      $this->fileService->moveDirectory(
        'product-images/' . $productVariant->product->slug . '/' . $productVariant->slug,
        'product-images/' . $productVariant->product->slug . '/' . $slug,
      );
    }

    $productVariant->update([
      'slug'          => $slug,
      'price_basic'   => $request->input('product-variant-basic-price'),
      'price_middle'  => $request->input('product-variant-middle-price'),
      'price_full'    => $request->input('product-variant-full-price'),
      'living_area'   => $request->input('product-variant-living-area'),
      'building_area' => $request->input('product-variant-building-area'),
      'is_active'     => $request->has('product-variant-available'),
    ]);
  }

  public function updateTranslation(TranslationsProductVariants $translation, string $name, string $description): void
  {
    $translation->update([
      'name'        => $name,
      'description' => $description,
    ]);
  }

  public function destroyProductVariant(ProductVariant $productVariant): void
  {
    $productVariant->delete();
    $this->fileService->destroyDirectory('product-images/' . $productVariant->product->slug . '/' . $productVariant->slug);
  }

  public function syncImages(ProductVariant $productVariant, array $submittedFiles): void
  {
    $basePath = 'product-images/' . $productVariant->product->slug . '/' . $productVariant->slug;
    $existing = $productVariant->productVariantImages->keyBy('filename');

    foreach ($submittedFiles as $index => $file) {
      if ($file === null) {
        continue;
      }

      $filename = basename($file);

      if (str_starts_with($file, 'uploads/temp/')) {
        $this->fileService->storeFile($file, $basePath);
        $productVariant->productVariantImages()->create([
          'filename' => $filename,
          'order'    => $index,
        ]);
      } else {
        $existing->get($filename)?->update(['order' => $index]);
        $existing->forget($filename);
      }
    }

    foreach ($existing as $image) {
      $this->fileService->destroyFile($image->filename, $basePath);
      $image->delete();
    }
  }

  public function syncPlans(ProductVariant $productVariant, array $submittedFiles): void
  {
    $basePath = 'product-images/' . $productVariant->product->slug . '/' . $productVariant->slug . '/plan';
    $locale = app()->getLocale();

    $existing = $productVariant->productVariantPlan()
                               ->withoutGlobalScope('order')
                               ->where('language', $locale)
                               ->get()
                               ->keyBy('filename');

    foreach ($submittedFiles as $index => $file) {
      if ($file === null) {
        continue;
      }

      $filename = basename($file);

      if (str_starts_with($file, 'uploads/temp/')) {
        $this->fileService->storeFile($file, $basePath);
        $productVariant->productVariantPlan()->create([
          'filename' => $filename,
          'language' => $locale,
          'order'    => $index,
        ]);
      } else {
        $existing->get($filename)?->update(['order' => $index]);
        $existing->forget($filename);
      }
    }

    foreach ($existing as $plan) {
      $this->fileService->destroyFile($plan->filename, $basePath);
      $plan->delete();
    }
  }

  public function syncAttachment(ProductVariant $productVariant, array $submittedFiles): void
  {
    $basePath = 'product-images/' . $productVariant->product->slug . '/' . $productVariant->slug;
    $locale = app()->getLocale();

    $existingAttachment = $productVariant->productVariantAttachments()
                                         ->where('language', $locale)
                                         ->first();

    $submittedFile = collect($submittedFiles)->first();

    if ($submittedFile === null) {
      if ($existingAttachment) {
        $this->fileService->destroyFile($existingAttachment->filename, $basePath);
        $existingAttachment->delete();
      }

      return;
    }

    if (str_starts_with($submittedFile, 'uploads/temp/')) {
      if ($existingAttachment) {
        $this->fileService->destroyFile($existingAttachment->filename, $basePath);
        $existingAttachment->update(['filename' => basename($submittedFile)]);
      } else {
        $productVariant->productVariantAttachments()->create([
          'filename' => basename($submittedFile),
          'language' => $locale,
        ]);
      }
      $this->fileService->storeFile($submittedFile, $basePath);
    }
  }
}
