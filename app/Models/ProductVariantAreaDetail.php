<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantAreaDetail extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'square_meters', 'language', 'product_variant_id'];

  public function productVariant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(ProductVariant::class);
  }
}
