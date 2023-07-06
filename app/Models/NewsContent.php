<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsContent extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'slug', 'content', 'language'];
  protected $with = ['newsImages', 'newsAttachments'];

  public function newsImages()
  {
    return $this->hasMany(NewsImage::class);
  }

  public function newsAttachments()
  {
    return $this->hasMany(NewsAttachment::class);
  }
}
