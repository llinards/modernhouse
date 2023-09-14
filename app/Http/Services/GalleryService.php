<?php

namespace App\Http\Services;

use App\Models\GalleryContent;
use Illuminate\Support\Str;

class GalleryService
{
  private string $slug;
  private object $gallery;

  private function setSlug(string $slug): void
  {
    $this->slug = Str::slug($slug);
  }

  private function getGallery(string $id): object
  {
    return GalleryContent::findOrFail($id);
  }

  public function getTranslation()
  {
    return $this->gallery->translations()->where('language', app()->getLocale())->first();
  }

  public function addGallery(object $data): void
  {
    $this->setSlug($data['gallery-title']);
    $this->gallery = GalleryContent::create([
      'slug' => $this->slug,
      'is_video' => isset($data['gallery-type']),
      'is_pinned' => isset($data['gallery-pinned'])
    ]);
  }

  public function updateGallery(object $data)
  {
    $fileService = new FileService();
    $this->gallery = $this->getGallery($data['id']);
    $this->setSlug(app()->getLocale() === 'lv' ? $data['gallery-title'] : $this->gallery->slug);
    $isSlugChanged = $this->gallery->slug !== $this->slug;
    if ($isSlugChanged && (app()->getLocale() === 'lv')) {
      $fileService->moveDirectory('gallery/'.$this->gallery->slug, 'gallery/'.$this->slug);
    }
    $this->gallery->update([
      'slug' => $this->slug,
      'is_video' => isset($data['gallery-type']),
      'is_pinned' => isset($data['gallery-pinned'])
    ]);
  }

  public function destroyGallery(object $data): void
  {
    $this->gallery = $this->getGallery($data->id);
    $fileService = new FileService();
    $fileService->destroyDirectory('gallery/'.$this->gallery->slug);
    $this->gallery->delete();
  }

  public function addTranslation(object $data): void
  {
    $this->gallery->translations()->create([
      'title' => $data['gallery-title'],
      'content' => $data['gallery-content'],
      'language' => app()->getLocale()
    ]);
  }

  public function updateTranslation($translation, $data): void
  {
    $translation->update([
      'title' => $data['gallery-title'],
      'content' => $data['gallery-content']
    ]);
  }

  //TODO: maybe this should be extracted also as a seperate method
  public function addImage(array $images): void
  {
    foreach ($images as $image) {
      $fileService = new FileService();
      $fileService->storeFile($image, 'gallery/'.$this->slug);
      $this->gallery->galleryImages()->create([
        'filename' => basename($image)
      ]);
    }
  }

  public function destroyImage(object $data): void
  {
    $fileService = new FileService();
    $fileService->destroyFile($data->filename, 'gallery/'.$data->galleryContent->slug);
    $data->delete();
  }
}
