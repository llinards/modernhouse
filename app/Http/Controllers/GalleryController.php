<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryContentRequest;
use App\Http\Requests\UpdateGalleryContentRequest;
use App\Http\Services\GalleryService;
use App\Models\GalleryContent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
  public function index()
  {
    $galleryContents = GalleryContent::select('id', 'slug', 'is_video')
      ->with([
        'galleryImages' => function ($query) {
          $query->select('filename', 'gallery_content_id');
        },
        'translations' => function ($query) {
          $query->select('title', 'content', 'gallery_content_id')->where('language', app()->getLocale());
        },
      ])
      ->whereHas('translations', function ($query) {
        $query->where('language', app()->getLocale());
      })
      ->orderByDesc('is_pinned')
      ->orderBy('created_at', 'desc')
      ->get();
    return view('gallery')->with('galleryContents', $galleryContents);
  }

  public function indexAdmin()
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

  public function store(StoreGalleryContentRequest $data, GalleryService $galleryService)
  {
    try {
      $galleryService->addGallery($data);
      $galleryService->addTranslation($data);
      $galleryService->addImage($data['gallery-images']);
      return redirect('/admin/gallery')->with('success', 'Pievienots!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function show(GalleryContent $gallery)
  {
    $galleryContent = GalleryContent::select('id', 'slug', 'is_video', 'is_pinned')
      ->with([
        'translations' => function ($query) {
          $query->select('title', 'content', 'gallery_content_id')->where('language', app()->getLocale());
        },
        'galleryImages' => function ($query) {
          $query->select('id', 'filename', 'gallery_content_id');
        }
      ])
      ->findOrFail($gallery->id);
    return view('admin.gallery.edit', compact('galleryContent'));
  }

  public function update(UpdateGalleryContentRequest $data, GalleryService $galleryService)
  {
    try {
      $galleryService->updateGallery($data);
      $translation = $galleryService->getTranslation();
      if ($translation) {
        $galleryService->updateTranslation($translation, $data);
      } else {
        $galleryService->addTranslation($data);
      }
      if (isset($data['gallery-images'])) {
        $galleryService->addImage($data['gallery-images']);
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
