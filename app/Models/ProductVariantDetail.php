<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantDetail extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'hasThis', 'icon', 'count', 'product_variant_id', 'language'];

  public function productVariant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(ProductVariant::class);
  }
}
