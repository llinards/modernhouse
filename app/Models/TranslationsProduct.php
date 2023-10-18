<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationsProduct extends Model
{
  protected $fillable = [
    'name',
    'language',
    'product_id'
  ];

  public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Product::class);
  }
}
