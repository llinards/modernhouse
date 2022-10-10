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

    public function productOptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
      return $this->hasMany(Option::class);
    }

    public function productImages(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
      return $this->hasManyThrough(Image::class, Option::class);
    }
}
