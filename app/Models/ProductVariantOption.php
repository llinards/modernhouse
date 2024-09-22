<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantOption extends Model
{
  protected $fillable = ['option_title', 'product_variant_id', 'language'];

  public function productVariant()
  {
    return $this->belongsTo(ProductVariant::class);
  }

  public function productVariantOptionDetails()
  {
    return $this->hasMany(ProductVariantOptionDetail::class);
  }
}
