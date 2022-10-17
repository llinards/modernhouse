<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

  public function getRouteKeyName(): string
  {
    return 'slug';
  }

    public function productVariants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
      return $this->hasMany(ProductVariant::class);
    }

    public function productVariantImages(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
      return $this->hasManyThrough(Image::class, ProductVariant::class);
    }

    public function productVariantOptions(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
      return $this->hasManyThrough(ProductVariantOption::class, ProductVariant::class);
    }
}
