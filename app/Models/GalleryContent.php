<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryContent extends Model
{
  protected $fillable = ['slug', 'is_video', 'is_pinned'];

  public function galleryImages(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(GalleryImage::class);
  }

  public function translations(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(TranslationsGalleryContent::class);
  }
}
