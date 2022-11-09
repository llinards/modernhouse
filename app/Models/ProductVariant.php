<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['name','price','price_basic','price_full','description','product_id'];
    use HasFactory;

  public function productVariantImages(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Image::class);
  }
}
