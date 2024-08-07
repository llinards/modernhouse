<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantImage extends Model
{
  protected $fillable = ['filename', 'product_variant_id'];
  use HasFactory;

  public function productVariant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(ProductVariant::class);
  }
}
