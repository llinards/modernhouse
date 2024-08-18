<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantImage extends Model
{
  protected $fillable = ['filename', 'product_variant_id', 'order'];
  use HasFactory;

  protected static function boot(): void
  {
    parent::boot();

    static::addGlobalScope('order', static function (Builder $builder) {
      $builder->orderBy('order');
    });
  }

  public function productVariant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(ProductVariant::class);
  }
}
