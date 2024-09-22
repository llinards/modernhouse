<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantOptionDetail extends Model
{
  protected $fillable = ['detail', 'has_in_basic', 'has_in_middle', 'has_in_full', 'product_variant_option_id'];

  public function productVariantOption()
  {
    return $this->belongsTo(ProductVariantOption::class);
  }
}
