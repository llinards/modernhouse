<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryContentRequest;
use App\Http\Requests\UpdateGalleryContentRequest;
use App\Models\GalleryContent;
use App\Models\ProductVariant;
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
          'filename' => $fileName
        ]);
      }
      return redirect('/admin/gallery')->with('success', Lang::get('added'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }

  public function show(GalleryContent $gallery)
  {
    return view('admin.gallery.edit', compact('gallery'));
  }

  public function update(UpdateGalleryContentRequest $data)
  {
    try {
      $galleryToUpdate = GalleryContent::findOrFail($data->id);
      if ($data['gallery-title'] !== $galleryToUpdate->title) {
        $newGalleryDirectory = 'gallery/' . Str::slug($data['gallery-title']);
        $oldGalleryDirectory = 'gallery/' . Str::slug($galleryToUpdate->title);
        Storage::disk('public')->makeDirectory($newGalleryDirectory);
        Storage::disk('public')->move($oldGalleryDirectory, $newGalleryDirectory);
      }
      $galleryToUpdate->update([
        'title' => $data['gallery-title'],
        'content' => $data['gallery-content'],
      ]);
      if (isset($data['gallery-images'])) {
        foreach ($data['gallery-images'] as $image) {
          $fileName = basename($image);
          Storage::disk('public')->move($image, 'gallery/' . Str::slug($data['gallery-title']) . '/' . $fileName);
          $galleryToUpdate->galleryImages()->create([
            'filename' => $fileName
          ]);
        }
      }
      return back()->with('success', Lang::get('updated'));
    } catch (\Exception $e) {
      return back()->with('error', Lang::get('error try again'));
    }
  }
}
