<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
  public function store(Request $data)
  {
    if ($data->hasFile('product-cover-photo')) {
      $files = $data->file('product-cover-photo');
      foreach ($files as $file) {
        $fileExtension = $file->getClientOriginalExtension();
        return $file->storeAs('uploads/temp', 'cover.'.$fileExtension, 'public');
      }
    }
    if ($data->hasFile('product-variant-images')) {
      $files = $data->file('product-variant-images');
      foreach ($files as $file) {
        $fileName = $file->getClientOriginalName();
        return $file->storeAs('uploads/temp', $fileName, 'public');
      }
    }
    if ($data->hasFile('gallery-images')) {
      $files = $data->file('gallery-images');
      foreach ($files as $file) {
        $fileName = $file->getClientOriginalName();
        return $file->storeAs('uploads/temp', $fileName, 'public');
      }
    }
    if ($data->hasFile('news-images')) {
      $files = $data->file('news-images');
      foreach ($files as $file) {
        $fileName = $file->getClientOriginalName();
        return $file->storeAs('uploads/temp', $fileName, 'public');
      }
    }
    if ($data->hasFile('news-attachments')) {
      $files = $data->file('news-attachments');
      foreach ($files as $file) {
        $fileName = $file->getClientOriginalName();
        return $file->storeAs('uploads/temp', $fileName, 'public');
      }
    }
    return '';
  }

  public function destroy(Request $data)
  {
    Storage::delete('public/'.$data->getContent());
    return '';
  }
}
