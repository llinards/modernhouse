<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantOptionDetail extends Model
{
  protected $fillable = ['option', 'basic', 'full', 'product_variant_option_id'];
}
