<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    public function galleryContent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
      return $this->belongsTo(GalleryContent::class);
    }
}
