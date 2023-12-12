<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
  use HasFactory;

  protected $fillable = ['image_location', 'news_content_id'];

  public function newsContent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(NewsContent::class);
  }
}
