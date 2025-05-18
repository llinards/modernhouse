<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariant extends Model
{
  protected $fillable = [
    'slug', 'price_basic', 'price_middle', 'price_full', 'product_id', 'is_active', 'building_area', 'living_area',
  ];
  use HasFactory;

  public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Product::class);
  }

  public function productVariantImages(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(ProductVariantImage::class);
  }

  public function productVariantDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(ProductVariantDetail::class);
  }

  public function productVariantOptions(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(ProductVariantOption::class);
  }

  public function productVariantOptionsByCategory(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->productVariantOptions()->orderBy('option_category');
  }

  public function translations(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(TranslationsProductVariants::class);
  }

  public function productVariantPlan(): HasMany
  {
    return $this->hasMany(ProductVariantPlan::class);
  }

  public function productVariantAttachments(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(ProductVariantAttachment::class);
  }
}
