<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_location', 'gallery_content_id'];

    public function galleryContent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
      return $this->belongsTo(GalleryContent::class);
    }
}
