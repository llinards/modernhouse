<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
  protected $fillable = ['slug', 'is_video', 'is_pinned'];

  public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(GalleryImage::class);
  }

  public function translations(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(TranslationsGallery::class);
  }
}
