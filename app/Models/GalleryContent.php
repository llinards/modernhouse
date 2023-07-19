<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryContent extends Model
{
  protected $fillable = ['title', 'content', 'slug'];

//  protected $with = ['translations', 'galleryImages'];

  public function galleryImages(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(GalleryImage::class);
  }

  public function translations(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(TranslationsGalleryContent::class);
  }
}
