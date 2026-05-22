<?php

namespace App\Http\Services;

use App\Models\PromoModal;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PromoModalService
{
  /**
   * @param  array<string, mixed>  $data
   */
  public function update(array $data): void
  {
    $promoModal = PromoModal::current();

    $promoModal->fill([
      'is_enabled' => $data['is_enabled'] ?? false,
      'starts_at' => $data['starts_at'] ?? null,
      'ends_at' => $data['ends_at'] ?? null,
      'title' => $data['title'],
      'description' => $data['description'] ?? null,
      'cta_label' => $data['cta_label'],
      'cta_url' => $data['cta_url'],
    ]);

    $imageInput = $data['promo-modal-image'] ?? null;

    // FilePond resubmits the already-stored image path when no new file is
    // chosen, so only treat genuine fresh temp uploads as a replacement.
    if (is_array($imageInput) && isset($imageInput[0]) && str_starts_with($imageInput[0], 'uploads/temp/')) {
      $promoModal->image_filename = $this->replaceImage($imageInput[0], $promoModal->image_filename);
    }

    $promoModal->save();
  }

  private function replaceImage(string $tempPath, ?string $currentFilename): string
  {
    $disk = Storage::disk('public');

    if ($currentFilename) {
      $disk->delete(PromoModal::IMAGE_DIRECTORY.'/'.$currentFilename);
    }

    $filename = Str::random(20).'.'.pathinfo($tempPath, PATHINFO_EXTENSION);

    $disk->move($tempPath, PromoModal::IMAGE_DIRECTORY.'/'.$filename);

    return $filename;
  }
}
