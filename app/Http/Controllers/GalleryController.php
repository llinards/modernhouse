<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryContentRequest;
use App\Models\GalleryContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
  public function index()
  {
    $allGalleryContent = GalleryContent::all();
    return view('admin.gallery.index', compact('allGalleryContent'));
  }

  public function create()
  {
    return view('admin.gallery.create');
  }

  public function store(StoreGalleryContentRequest $data)
  {
    try {
      $newGalleryContent = GalleryContent::create([
        'title' => $data['gallery-title'],
        'content' => $data['gallery-content']
      ]);
      foreach ($data['gallery-images'] as $image) {
        $fileName = basename($image);
        Storage::disk('public')->move($image, 'gallery/' . Str::slug($data['gallery-title']) . '/' . $fileName);
        $newGalleryContent->galleryImages()->create([
          'image_location' => Str::slug($data['gallery-title']) . '/' . $fileName
        ]);
      }
      return redirect('/admin/gallery')->with('success', Lang::get('added'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }
}
