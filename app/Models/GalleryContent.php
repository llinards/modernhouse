<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GalleryContent extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    public function galleryImages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
      return $this->hasMany(GalleryImage::class);
    }
}
