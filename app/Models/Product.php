<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  protected $fillable = ['slug', 'cover_photo_filename', 'cover_video_filename', 'is_active', 'order'];

  public function getRouteKeyName(): string
  {
    return 'slug';
  }

  protected static function boot(): void
  {
    parent::boot();

    static::addGlobalScope('order', static function (Builder $builder) {
      $builder->orderBy('order');
    });
  }

  public function productVariants(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(ProductVariant::class);
  }

  public function translations(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(TranslationsProduct::class);
  }
}
