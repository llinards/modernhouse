<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantOption extends Model
{
  protected $fillable = ['option_title', 'option_category', 'options', 'product_variant_id', 'language'];

  use HasFactory;
}
