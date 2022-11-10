<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
  public function destroy (Image $image)
  {
    try {
      $product = Str::slug($image->productVariant->product->slug);
      $productVariant = Str::slug($image->productVariant->name);
      $image->delete();
      Storage::disk('public')->delete('product-images/'.$product.'/'.$productVariant.'/'.$image->filename);
      return back()->with('success', Lang::get('image deleted'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }
}
