<?php

namespace App\Http\Services;

use App\Models\GalleryContent;
use Illuminate\Support\Str;

class GalleryService
{
  private string $slug;

  private function setSlug(object $data): void
  {
    $this->slug = Str::slug($data['gallery-title']);
  }

  public function addGallery(object $data): void
  {
    $this->setSlug($data);
    $newGallery = GalleryContent::create([
      'slug' => $this->slug,
      'is_video' => isset($data['gallery-type']),
      'is_pinned' => isset($data['gallery-pinned'])
    ]);
    $this->addTranslation($newGallery, $data);
    $this->addImages($newGallery, $data['gallery-images']);
  }

  private function addTranslation(object $gallery, object $data): void
  {
    $gallery->translations()->create([
      'title' => $data['gallery-title'],
      'content' => $data['gallery-content'],
      'language' => app()->getLocale()
    ]);
  }

  private function addImages(object $gallery, array $images): void
  {
    foreach ($images as $image) {
      $fileService = new FileService();
      $fileService->storeFile($image, 'gallery/'.$this->slug);
      $gallery->galleryImages()->create([
        'filename' => basename($image)
      ]);
    }
  }
}
