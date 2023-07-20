<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryContentRequest;
use App\Http\Requests\UpdateGalleryContentRequest;
use App\Models\GalleryContent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
  public function index()
  {
    $galleryContents = GalleryContent::select('id', 'slug')
      ->with([
        'translations' => function ($query) {
          $query->select('title', 'gallery_content_id')->where('language', app()->getLocale());
        },
      ])
      ->orderBy('created_at', 'desc')
      ->get();
    return view('admin.gallery.index', compact('galleryContents'));
  }

  public function create()
  {
    return view('admin.gallery.create');
  }

  public function store(StoreGalleryContentRequest $data)
  {
    $galleryContentSlug = Str::slug($data['gallery-title']);
    try {
      //TODO: refactor what's being created in the main table
      $newGalleryContent = GalleryContent::create([
        'title' => $data['gallery-title'],
        'content' => $data['gallery-content'],
        'slug' => $galleryContentSlug
      ]);
      $newGalleryContent->translations()->create([
        'title' => $data['gallery-title'],
        'content' => $data['gallery-content'],
        'language' => app()->getLocale()
      ]);
      foreach ($data['gallery-images'] as $image) {
        $fileName = basename($image);
        Storage::disk('public')->move($image, 'gallery/'.$galleryContentSlug.'/'.$fileName);
        $newGalleryContent->galleryImages()->create([
          'filename' => $fileName
        ]);
      }
      return redirect('/admin/gallery')->with('success', 'Pievienots!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function show(GalleryContent $gallery)
  {
    $galleryContent = GalleryContent::select('id', 'slug')
      ->with([
        'translations' => function ($query) {
          $query->select('title', 'content', 'gallery_content_id')->where('language', app()->getLocale());
        },
        'galleryImages' => function ($query) {
          $query->select('filename', 'gallery_content_id');
        }
      ])
      ->findOrFail($gallery->id);
    return view('admin.gallery.edit', compact('galleryContent'));
  }

  public function update(UpdateGalleryContentRequest $data)
  {
    try {
      $galleryToUpdate = GalleryContent::findOrFail($data->id);
      $galleryContentSlug = app()->getLocale() === 'lv' ? Str::slug($data['gallery-title']) : $galleryToUpdate->slug;
      $galleryTranslationToUpdate = $galleryToUpdate->translations()->where('language', app()->getLocale())->first();

      if ($galleryTranslationToUpdate) {
        $galleryToUpdate->translations()->where('language', app()->getLocale())->update([
          'title' => $data['gallery-title'],
          'content' => $data['gallery-content']
        ]);
      } else {
        $galleryToUpdate->translations()->create([
          'title' => $data['gallery-title'],
          'content' => $data['gallery-content'],
          'language' => app()->getLocale()
        ]);
      }

      if ((app()->getLocale() === 'lv') && $galleryContentSlug !== $galleryToUpdate->slug) {
        $newGalleryDirectory = 'gallery/'.$galleryContentSlug;
        $oldGalleryDirectory = 'gallery/'.$galleryToUpdate->slug;
        Storage::disk('public')->makeDirectory($newGalleryDirectory);
        Storage::disk('public')->move($oldGalleryDirectory, $newGalleryDirectory);
      }
      //TODO: refactor what's being created in the main table
      $galleryToUpdate->update([
        'title' => $data['gallery-title'],
        'content' => $data['gallery-content'],
        'slug' => $galleryContentSlug
      ]);
      if (isset($data['gallery-images'])) {
        foreach ($data['gallery-images'] as $image) {
          $fileName = basename($image);
          Storage::disk('public')->move($image, 'gallery/'.$galleryContentSlug.'/'.$fileName);
          $galleryToUpdate->galleryImages()->create([
            'filename' => $fileName
          ]);
        }
      }
      return back()->with('success', 'Atjaunots!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(GalleryContent $gallery)
  {
    try {
      Storage::disk('public')->deleteDirectory('gallery/'.$gallery->slug);
      $gallery->delete();
      return back()->with('success', 'Dzēsts!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
