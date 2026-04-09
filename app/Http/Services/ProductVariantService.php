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
      'slug'          => $this->slug,
      'price_basic'   => $data['product-variant-basic-price'],
      'price_middle'  => $data['product-variant-middle-price'],
      'price_full'    => $data['product-variant-full-price'],
      'product_id'    => $data['product-id'],
      'living_area'   => $data['product-variant-living-area'],
      'building_area' => $data['product-variant-building-area'],
      'is_active'     => false,
    ]);
  }

  public function addTranslation(object $data): void
  {
    $this->productVariant->translations()->create([
      'name'        => $data['product-variant-name'],
      'description' => $data['product-variant-description'],
      'language'    => app()->getLocale(),
    ]);
  }

  public function addImage(array $images): void
  {
    foreach ($images as $index => $image) {
      if ($image !== null) {
        $fileService = new FileService();
        $fileService->storeFile($image, 'product-images/'.$this->productVariant->product->slug.'/'.$this->slug);
        $this->productVariant->productVariantImages()->create([
          'filename' => basename($image),
          'order'    => $index,
        ]);
      }
    }
  }

  public function addPlan(array $files): void
  {
    foreach ($files as $index => $file) {
      if ($file !== null) {
        $fileService = new FileService();
        $fileService->storeFile($file, 'product-images/'.$this->productVariant->product->slug.'/'.$this->slug.'/plan');
        $this->productVariant->productVariantPlan()->create([
          'filename' => basename($file),
          'language' => app()->getLocale(),
          'order'    => $index,
        ]);
      }
    }
  }

  public function addAttachment(array $attachments): void
  {
    foreach ($attachments as $attachment) {
      if ($attachment !== null) {
        $fileService = new FileService();

        $existingAttachment = $this->productVariant->productVariantAttachments()
                                                   ->where('language', app()->getLocale())
                                                   ->first();
        if ($existingAttachment) {
          $fileService->destroyFile($existingAttachment->filename,
            'product-images/'.$this->productVariant->product->slug.'/'.$this->slug);
          $existingAttachment->update([
            'filename' => basename($attachment),
          ]);
        } else {
          $this->productVariant->productVariantAttachments()->create([
            'filename' => basename($attachment),
            'language' => app()->getLocale(),
          ]);
        }
        $fileService->storeFile($attachment, 'product-images/'.$this->productVariant->product->slug.'/'.$this->slug);
      }
    }
  }

  public function updateProductVariant(object $data): void
  {
    $fileService          = new FileService();
    $this->productVariant = $this->getProductVariant($data['id']);
    $this->setSlug(app()->getLocale() === 'lv' ? $data['product-variant-name'] : $this->productVariant->slug);
    $isSlugChanged = $this->productVariant->slug !== $this->slug;
    if ($isSlugChanged && (app()->getLocale() === 'lv')) {
      $fileService->moveDirectory('product-images/'.$this->productVariant->product->slug.'/'.$this->productVariant->slug,
        'product-images/'.$this->productVariant->product->slug.'/'.$this->slug);
    }
    $this->productVariant->update([
      'slug'          => $this->slug,
      'price_basic'   => $data['product-variant-basic-price'],
      'price_middle'  => $data['product-variant-middle-price'],
      'price_full'    => $data['product-variant-full-price'],
      'living_area'   => $data['product-variant-living-area'],
      'building_area' => $data['product-variant-building-area'],
      'is_active'     => isset($data['product-variant-available']),
    ]);
  }

  public function updateTranslation($translation, $data): void
  {
    $translation->update([
      'name'        => $data['product-variant-name'],
      'description' => $data['product-variant-description'],
    ]);
  }

  public function destroyProductVariant(object $data): void
  {
    $this->productVariant = $this->getProductVariant($data->id);
    $fileService          = new FileService();
    $fileService->destroyDirectory('product-images/'.$this->productVariant->product->slug.'/'.$this->productVariant->slug);
    $this->productVariant->delete();
  }

  public function syncImages(array $submittedFiles): void
  {
    $fileService = new FileService();
    $basePath = 'product-images/'.$this->productVariant->product->slug.'/'.$this->slug;

    $existing = $this->productVariant->productVariantImages->keyBy('filename');

    foreach ($submittedFiles as $index => $file) {
      if ($file === null) {
        continue;
      }

      $filename = basename($file);

      if (str_starts_with($file, 'uploads/temp/')) {
        $fileService->storeFile($file, $basePath);
        $this->productVariant->productVariantImages()->create([
          'filename' => $filename,
          'order'    => $index,
        ]);
      } else {
        $existing->get($filename)?->update(['order' => $index]);
        $existing->forget($filename);
      }
    }

    foreach ($existing as $image) {
      $fileService->destroyFile($image->filename, $basePath);
      $image->delete();
    }
  }

  public function syncPlans(array $submittedFiles): void
  {
    $fileService = new FileService();
    $basePath = 'product-images/'.$this->productVariant->product->slug.'/'.$this->slug.'/plan';
    $locale = app()->getLocale();

    $existing = $this->productVariant->productVariantPlan()
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
        $fileService->storeFile($file, $basePath);
        $this->productVariant->productVariantPlan()->create([
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
      $fileService->destroyFile($plan->filename, $basePath);
      $plan->delete();
    }
  }

  public function syncAttachment(array $submittedFiles): void
  {
    $fileService = new FileService();
    $basePath = 'product-images/'.$this->productVariant->product->slug.'/'.$this->slug;
    $locale = app()->getLocale();

    $existingAttachment = $this->productVariant->productVariantAttachments()
                                               ->where('language', $locale)
                                               ->first();

    $submittedFile = collect($submittedFiles)->first();

    if ($submittedFile === null) {
      if ($existingAttachment) {
        $fileService->destroyFile($existingAttachment->filename, $basePath);
        $existingAttachment->delete();
      }

      return;
    }

    if (str_starts_with($submittedFile, 'uploads/temp/')) {
      if ($existingAttachment) {
        $fileService->destroyFile($existingAttachment->filename, $basePath);
        $existingAttachment->update(['filename' => basename($submittedFile)]);
      } else {
        $this->productVariant->productVariantAttachments()->create([
          'filename' => basename($submittedFile),
          'language' => $locale,
        ]);
      }
      $fileService->storeFile($submittedFile, $basePath);
    }
  }
}
