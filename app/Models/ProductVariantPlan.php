<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantPlan extends Model
{

  protected $fillable = [
    'product_variant_id', 'filename', 'language',
  ];

  public function productVariant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(ProductVariant::class);
  }
}
