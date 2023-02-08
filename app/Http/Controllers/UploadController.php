<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
  public function store(Request $data)
  {
    if ($data->hasFile('product-cover-photo')) {
      $file = $data->file('product-cover-photo');
      return $file->storeAs('uploads/temp', 'cover.' . $file->getClientOriginalExtension(), 'public');
    }
    if ($data->hasFile('product-variant-images')) {
      $files = $data->file('product-variant-images');
      foreach($files as $file) {
        $fileName = $file->getClientOriginalName();
        return $file->storeAs('uploads/temp', $fileName,  'public');
      }
    }
    if ($data->hasFile('gallery-images')) {
      $files = $data->file('gallery-images');
      foreach($files as $file) {
        $fileName = $file->getClientOriginalName();
        return $file->storeAs('uploads/temp', $fileName, 'public');
      }
    }
    return '';
  }

  public function destroy(Request $data)
  {
    Storage::delete('public/' . $data->getContent());
    return '';
  }
}
