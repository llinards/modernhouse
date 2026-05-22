<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoModal extends Model
{
  /** @use HasFactory<\Database\Factories\PromoModalFactory> */
  use HasFactory;

  public const IMAGE_DIRECTORY = 'promo-modal';

  protected $fillable = [
    'is_enabled',
    'starts_at',
    'ends_at',
    'image_filename',
    'title',
    'description',
    'cta_label',
    'cta_url',
  ];

  protected function casts(): array
  {
    return [
      'is_enabled' => 'boolean',
      'starts_at' => 'date',
      'ends_at' => 'date',
    ];
  }

  /**
   * The promo modal is a single-row settings record. Always return an
   * instance so admin forms and the service have something to work with.
   */
  public static function current(): self
  {
    return static::query()->firstOrNew([]);
  }

  public function shouldDisplay(): bool
  {
    if (! $this->is_enabled) {
      return false;
    }

    if (! $this->image_filename || ! $this->title || ! $this->cta_label || ! $this->cta_url) {
      return false;
    }

    $now = now();

    if ($this->starts_at && $now->lt($this->starts_at->startOfDay())) {
      return false;
    }

    if ($this->ends_at && $now->gt($this->ends_at->endOfDay())) {
      return false;
    }

    return true;
  }

  public function getImageUrlAttribute(): ?string
  {
    return $this->image_filename
      ? asset('storage/'.self::IMAGE_DIRECTORY.'/'.$this->image_filename)
      : null;
  }
}
