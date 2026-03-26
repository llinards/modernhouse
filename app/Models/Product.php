<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
  use HasFactory;

  protected $fillable = ['slug', 'cover_photo_filename', 'cover_video_filename', 'is_active', 'order'];

  protected function casts(): array
  {
    return [
      'is_active' => 'boolean',
    ];
  }

  public function getRouteKeyName(): string
  {
    return 'slug';
  }

  public function scopeOrdered(Builder $query): Builder
  {
    return $query->orderBy('order');
  }

  public function productVariants(): HasMany
  {
    return $this->hasMany(ProductVariant::class);
  }

  public function translations(): HasMany
  {
    return $this->hasMany(TranslationsProduct::class);
  }
}
