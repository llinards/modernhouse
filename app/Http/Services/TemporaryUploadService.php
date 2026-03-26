<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TemporaryUploadService
{
  private const FILE_TYPES = [
    'product-cover-photo',
    'product-cover-video',
    'product-variant-images',
    'gallery-images',
    'news-images',
    'news-attachments',
    'product-variant-attachments',
    'product-variant-options-excel',
    'product-variant-plan',
    'introduction-video',
  ];

  public function store(Request $request): string
  {
    foreach (self::FILE_TYPES as $fileType) {
      if ($request->hasFile($fileType)) {
        $file = $request->file($fileType)[0];
        $fileName = $this->resolveFileName($fileType, $file);

        return $file->storeAs('uploads/temp', $fileName, 'public');
      }
    }

    return '';
  }

  public function destroy(string $path): void
  {
    if (! $this->isValidTemporaryPath($path)) {
      abort(403);
    }

    Storage::disk('public')->delete($path);
  }

  public function load(string $path): BinaryFileResponse
  {
    if (! $path || ! Storage::disk('public')->exists($path)) {
      abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));
  }

  private function resolveFileName(string $fileType, UploadedFile $file): string
  {
    return match ($fileType) {
      'product-cover-photo' => 'cover.'.$file->getClientOriginalExtension(),
      'product-variant-plan' => Str::random(10).'.'.$file->getClientOriginalExtension(),
      default => $file->getClientOriginalName(),
    };
  }

  private function isValidTemporaryPath(string $path): bool
  {
    return Str::startsWith($path, 'uploads/temp/') && ! Str::contains($path, '..');
  }
}
