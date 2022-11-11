<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['filename', 'product_variant_id'];
    use HasFactory;

    public function productVariant()
    {
      return $this->belongsTo(ProductVariant::class);
    }
}
