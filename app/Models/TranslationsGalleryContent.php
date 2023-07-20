<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationsGalleryContent extends Model
{
  protected $fillable = [
    'title',
    'content',
    'language',
    'gallery_content_id'
  ];

  public function galleryContent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(GalleryContent::class);
  }
}
