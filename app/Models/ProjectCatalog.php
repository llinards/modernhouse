<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectCatalog extends Model
{
  protected $fillable = ['order', 'is_active'];

  protected function casts(): array
  {
    return [
      'is_active' => 'boolean',
    ];
  }

  public function scopeOrdered(Builder $query): Builder
  {
    return $query->orderBy('order');
  }

  public function translations(): HasMany
  {
    return $this->hasMany(ProjectCatalogTranslation::class);
  }
}
