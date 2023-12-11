<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationsProductVariants extends Model
{
  protected $fillable = [
    'name',
    'description',
    'language',
    'product_variant_id'
  ];

  public function productVariant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(ProductVariant::class);
  }
}
