<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
  use HasFactory;

  public function getRouteKeyName(): string
  {
    return 'slug';
  }

  protected $fillable = ['title', 'slug', 'content', 'language'];

  public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(NewsImage::class);
  }

  public function attachments(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(NewsAttachment::class);
  }
}
