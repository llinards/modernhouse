<?php

namespace App\Http\Services;

use App\Models\GalleryContent;

class GalleryService
{
  private string $slug;
  private object $gallery;

  private function setSlug(string $slug): void
  {
    $this->slug = $slug;
  }

  private function getGallery(string $id): object
  {
    return GalleryContent::findOrFail($id);
  }

  public function addGallery(object $data): void
  {
    $this->setSlug($data['gallery-title']);
    $this->gallery = GalleryContent::create([
      'slug' => $this->slug,
      'is_video' => isset($data['gallery-type']),
      'is_pinned' => isset($data['gallery-pinned'])
    ]);
    $this->addTranslation($data);
    $this->addImage($data['gallery-images']);
  }

  public function updateGallery(object $data)
  {
    $this->gallery = $this->getGallery($data['gallery-id']);
    $this->setSlug(app()->getLocale() === 'lv' ? $data['gallery-title'] : $this->gallery->slug);
    $isSlugChanged = $this->gallery->slug !== $this->slug;
    if ($isSlugChanged && (app()->getLocale() === 'lv')) {
      $fileService = new FileService();
      $fileService->moveDirectory('gallery/'.$this->gallery->slug, 'gallery/'.$this->slug);
    }
    $this->gallery->update([
      'slug' => $this->slug,
      'is_video' => isset($data['gallery-type']),
      'is_pinned' => isset($data['gallery-pinned'])
    ]);

  }

  private function addTranslation(object $data): void
  {
    $this->gallery->translations()->create([
      'title' => $data['gallery-title'],
      'content' => $data['gallery-content'],
      'language' => app()->getLocale()
    ]);
  }

  private function addImage(array $images): void
  {
    foreach ($images as $image) {
      $fileService = new FileService();
      $fileService->storeFile($image, 'gallery/'.$this->slug);
      $this->gallery->galleryImages()->create([
        'filename' => basename($image)
      ]);
    }
  }
}
