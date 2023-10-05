<?php

namespace App\Http\Services;

use App\Models\NewsContent;
use Illuminate\Support\Str;

class NewsService
{
  private string $slug;
  private object $news;

  private function setSlug(string $slug): void
  {
    $this->slug = Str::slug($slug);
  }

  private function getNews(string $id): object
  {
    return NewsContent::findOrFail($id);
  }

  public function addNews(object $data): void
  {
    $this->setSlug($data['news-title']);
    $this->news = NewsContent::create([
      'title' => $data['news-title'],
      'slug' => $this->slug,
      'content' => $data['news-content'],
      'language' => app()->getLocale(),
    ]);
  }

  public function addImage(array $images): void
  {
    foreach ($images as $image) {
      $fileService = new FileService();
      $fileService->storeFile($image, 'news/'.$this->slug);
      $this->news->newsImages()->create([
        'image_location' => basename($image)
      ]);
    }
  }

  public function addAttachment(array $attachments): void
  {
    foreach ($attachments as $attachment) {
      $fileService = new FileService();
      $fileService->storeFile($attachment, 'news/'.$this->slug);
      $this->news->newsAttachments()->create([
        'attachment_location' => basename($attachment)
      ]);
    }
  }

  public function updateNews(object $data): void
  {
    $fileService = new FileService();
    $this->news = $this->getNews($data['id']);
    $this->setSlug($data['news-title']);
    $isSlugChanged = $this->news->slug !== $this->slug;
    if ($isSlugChanged) {
      $fileService->moveDirectory('news/'.$this->news->slug, 'news/'.$this->slug);
    }
    $this->news->update([
      'title' => $data['news-title'],
      'slug' => $this->slug,
      'content' => $data['news-content']
    ]);
  }

  public function destroyNews(object $data): void
  {
    $this->news = $this->getNews($data->id);
    $fileService = new FileService();
    $fileService->destroyDirectory('news/'.$this->news->slug);
    $this->news->delete();
  }

  public function destroyImage(object $data): void
  {
    $fileService = new FileService();
    $fileService->destroyFile($data->image_location, 'news/'.$data->newsContent->slug);
    $data->delete();
  }

  public function destroyAttachment(object $data): void
  {
    $fileService = new FileService();
    $fileService->destroyFile($data->attachment_location, 'news/'.$data->newsContent->slug);
    $data->delete();
  }
}
