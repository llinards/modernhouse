<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantDetail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'hasThis', 'icon', 'count', 'order', 'product_variant_id', 'language'];

    protected static function booted(): void
    {
        static::addGlobalScope('order', static function (Builder $builder) {
            $builder->orderBy('order');
        });
    }

    public function productVariant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
