<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsAttachment extends Model
{
    use HasFactory;

    public function newsContent()
    {
      return $this->belongsTo(NewsContent::class);
    }
}
