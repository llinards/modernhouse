<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
  public function destroy(Image $image)
  {
    try {
      $product = Str::slug($image->productVariant->product->slug);
      $productVariant = Str::slug($image->productVariant->slug);
      $image->delete();
      Storage::disk('public')->delete('product-images/'.$product.'/'.$productVariant.'/'.$image->filename);
      return redirect()->to(app('url')->previous()."#product-variant-images")->with('success', 'Bilde dzēsta!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda!');
    }
  }
}
