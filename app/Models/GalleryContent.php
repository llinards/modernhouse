<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryContent extends Model
{
    use HasFactory;

    public function galleryImages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
      return $this->hasMany(GalleryImage::class);
    }
}
