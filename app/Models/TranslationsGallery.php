<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationsGallery extends Model
{
  protected $fillable = [
    'title',
    'content',
    'language',
    'gallery_id'
  ];

  public function gallery(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Gallery::class);
  }
}
