<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Http\Services\GalleryService;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
  public function index()
  {
    $galleries = Gallery::select('id', 'slug', 'is_video')
      ->with([
        'images' => function ($query) {
          $query->select('filename', 'gallery_id');
        },
        'translations' => function ($query) {
          $query->select('title', 'content', 'gallery_id')->where('language', app()->getLocale());
        },
      ])
      ->whereHas('translations', function ($query) {
        $query->where('language', app()->getLocale());
      })
      ->orderByDesc('is_pinned')
      ->orderBy('created_at', 'desc')
      ->simplePaginate(5);
    return view('gallery', compact('galleries'));
  }

  public function indexAdmin()
  {
    $galleries = Gallery::select('id', 'slug', 'is_pinned', 'is_video')
      ->with([
        'translations' => function ($query) {
          $query->select('title', 'gallery_id')->where('language', app()->getLocale());
        },
      ])
      ->orderByDesc('is_pinned')
      ->orderBy('created_at', 'desc')
      ->paginate(15);
    return view('admin.gallery.index', compact('galleries'));
  }

  public function create()
  {
    return view('admin.gallery.create');
  }

  public function store(StoreGalleryRequest $data, GalleryService $galleryService)
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

  public function show(Gallery $gallery)
  {
    $gallery = Gallery::select('id', 'slug', 'is_video', 'is_pinned')
      ->with([
        'translations' => function ($query) {
          $query->select('title', 'content', 'gallery_id')->where('language', app()->getLocale());
        },
        'images' => function ($query) {
          $query->select('id', 'filename', 'gallery_id');
        }
      ])
      ->findOrFail($gallery->id);
    return view('admin.gallery.edit', compact('gallery'));
  }

  public function update(UpdateGalleryRequest $data, GalleryService $galleryService)
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
      if ($e->getCode() === '23000') {
        return back()->with('error', 'Kļūda! Šāds nosaukums jau eksistē.');
      }
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(Gallery $gallery, GalleryService $galleryService)
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
      return redirect()->to(app('url')->previous()."#all-gallery-images")->with('success', 'Bilde dzēsta!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
