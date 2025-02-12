<?php

namespace App\Http\Services;

use App\Models\Gallery;
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
    return Gallery::findOrFail($id);
  }

  public function getTranslation()
  {
    return $this->gallery->translations()->where('language', app()->getLocale())->first();
  }

  public function addGallery(object $data): void
  {
    $this->setSlug($data['gallery-title']);
    $this->gallery = Gallery::create([
      'slug'      => $this->slug,
      'is_video'  => isset($data['gallery-type']),
      'is_pinned' => isset($data['gallery-pinned']),
    ]);
  }

  //TODO: maybe this should be extracted also as a seperate method
  public function addImage(array $images): void
  {
    foreach ($images as $image) {
      if ($image !== null) {
        $fileService = new FileService();
        $fileService->storeFile($image, 'gallery/'.$this->slug);
        $this->gallery->images()->create([
          'filename' => basename($image),
        ]);
      }
    }
  }

  public function addTranslation(object $data): void
  {
    $this->gallery->translations()->create([
      'title'    => $data['gallery-title'],
      'content'  => $data['gallery-content'],
      'language' => app()->getLocale(),
    ]);
  }

  public function updateGallery(object $data)
  {
    $fileService   = new FileService();
    $this->gallery = $this->getGallery($data['id']);
    $this->setSlug($data['gallery-title']);
    $isSlugChanged = $this->gallery->slug !== $this->slug;
    if ($isSlugChanged) {
      $fileService->moveDirectory('gallery/'.$this->gallery->slug, 'gallery/'.$this->slug);
    }
    $this->gallery->update([
      'slug'      => $this->slug,
      'is_video'  => isset($data['gallery-type']),
      'is_pinned' => isset($data['gallery-pinned']),
    ]);
  }

  public function updateTranslation($translation, $data): void
  {
    $translation->update([
      'title'   => $data['gallery-title'],
      'content' => $data['gallery-content'],
    ]);
  }

  public function destroyGallery(object $data): void
  {
    $this->gallery = $this->getGallery($data->id);
    $fileService   = new FileService();
    $fileService->destroyDirectory('gallery/'.$this->gallery->slug);
    $this->gallery->delete();
  }

  public function destroyImage(object $data): void
  {
    $fileService = new FileService();
    $fileService->destroyFile($data->filename, 'gallery/'.$data->gallery->slug);
    $data->delete();
  }
}
