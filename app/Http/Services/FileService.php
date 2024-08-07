<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
  public function storeFile(string $file, string $location): void
  {
    Storage::disk('public')->move($file, $location.'/'.basename($file));
  }

  public function destroyFile(string $file, string $location): void
  {
    Storage::disk('public')->delete($location.'/'.$file);
  }

  public function moveDirectory(string $oldDirectory, string $newDirectory): void
  {
    Storage::disk('public')->makeDirectory($newDirectory);
    Storage::disk('public')->move($oldDirectory, $newDirectory);
  }

  public function destroyDirectory(string $location): void
  {
    Storage::disk('public')->deleteDirectory($location);
  }
}
