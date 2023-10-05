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

  public function addNews(object $data): void
  {
    $this->setSlug($data['news-title']);
    $this->news = NewsContent::create([
      'title' => $data['news-title'],
      'slug' => $this->slug,
      'content' => $data['news-content'],
      'language' => $data['news-language'],
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
}
