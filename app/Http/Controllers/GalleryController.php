<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryContentRequest;
use App\Http\Requests\UpdateGalleryContentRequest;
use App\Http\Services\GalleryService;
use App\Models\GalleryContent;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Log;

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
      if ($e->getCode() === '23000') {
        return back()->with('error', 'Kļūda! Šāds nosaukums jau eksistē.');
      }
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
      if ($data->has(['gallery-images'])) {
        $galleryService->addImage($data['gallery-images']);
      }
      return back()->with('success', 'Atjaunots!');
    } catch (\Exception $e) {
      Log::error($e);
      if ($e->getCode() === '23000') {
        return back()->with('error', 'Kļūda! Šāds nosaukums jau eksistē.');
      }
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(GalleryContent $gallery, GalleryService $galleryService)
  {
    try {
      $galleryService->destroyGallery($gallery);
      return back()->with('success', 'Dzēsts!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroyImage(GalleryImage $image, GalleryService $galleryService)
  {
    try {
      $galleryService->destroyImage($image);
      return redirect()->to(app('url')->previous()."#gallery-images")->with('success', 'Bilde dzēsta!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
