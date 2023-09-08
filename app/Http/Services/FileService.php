<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
  public function storeFile(string $file, string $location): void
  {
    Storage::disk('public')->move($file, $location.'/'.basename($file));
  }
}
