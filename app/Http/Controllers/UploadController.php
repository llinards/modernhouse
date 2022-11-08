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
      $filePath = $file->storeAs('uploads/temp', 'cover.' . $file->getClientOriginalExtension(), 'public');
      return $filePath;
    }
    return '';
  }

  public function destroy(Request $data)
  {
    Storage::delete('public/' . $data->getContent());
    return '';
  }
}
