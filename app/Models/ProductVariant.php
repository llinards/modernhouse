<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
  protected $fillable = [
    'slug', 'name_lv', 'name_en', 'name_se', 'name_no', 'price_basic', 'price_full', 'description_lv', 'description_en',
    'description_se', 'description_no', 'product_id', 'is_active'
  ];
  use HasFactory;

  protected $with = ['productVariantAreaDetails', 'productVariantDetails'];

  public function productVariantImages(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Image::class);
  }

  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  public function productVariantAreaDetails()
  {
    return $this->hasMany(ProductVariantAreaDetail::class);
  }

  public function productVariantDetails()
  {
    return $this->hasMany(ProductVariantDetail::class);
  }

  public function productVariantOptions()
  {
    return $this->hasMany(ProductVariantOption::class);
  }

  public function productVariantOptionsByCategory()
  {
    return $this->productVariantOptions()->orderBy('option_category');
  }

}
