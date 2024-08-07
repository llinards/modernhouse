<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
  protected $fillable = ['filename', 'gallery_id'];

  public function gallery(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Gallery::class);
  }
}
