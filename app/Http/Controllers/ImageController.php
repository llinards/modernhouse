<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\Image;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
  public function destroy(Image $image)
  {
    try {
      $product = Str::slug($image->productVariant->product->slug);
      $productVariant = Str::slug($image->productVariant->name);
      $image->delete();
      Storage::disk('public')->delete('product-images/'.$product.'/'.$productVariant.'/'.$image->filename);
      return redirect()->to(app('url')->previous()."#product-variant-images")->with('success',
        Lang::get('image deleted'));
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', Lang::get('error try again'));
    }
  }

  public function destroyGalleryImages(GalleryImage $image)
  {
    try {
      $gallery = Str::slug($image->galleryContent->title);
      $image->delete();
      Storage::disk('public')->delete('gallery/'.$gallery.'/'.$image->filename);
      return redirect()->to(app('url')->previous()."#gallery-images")->with('success', Lang::get('image deleted'));
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', Lang::get('error try again'));
    }
  }
}
