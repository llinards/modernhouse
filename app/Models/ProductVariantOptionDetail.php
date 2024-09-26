<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductVariantOptionDetail extends Model
{
  protected $fillable = [
    'detail', 'has_in_basic', 'has_in_middle', 'has_in_full', 'product_variant_option_id', 'order',
  ];

  public function productVariantOption()
  {
    return $this->belongsTo(ProductVariantOption::class);
  }

  protected static function boot(): void
  {
    parent::boot();

    static::addGlobalScope('order', static function (Builder $builder) {
      $builder->orderBy('order');
    });
  }
}
