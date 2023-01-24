<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    use HasFactory;

  public function newsContent()
  {
    return $this->belongsTo(NewsContent::class);
  }
}
