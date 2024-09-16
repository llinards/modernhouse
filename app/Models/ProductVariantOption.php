<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantOption extends Model
{
  protected $fillable = ['option_title', 'product_variant_id', 'language'];

  public function productVariantOptionDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(ProductVariantOptionDetail::class);
  }
}
