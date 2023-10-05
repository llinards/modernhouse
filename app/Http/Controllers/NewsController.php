<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Services\NewsService;
use App\Models\NewsAttachment;
use App\Models\NewsContent;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{

  public function index()
  {
    $news = NewsContent::select('id', 'title', 'slug')
      ->with([
        'newsImages' => function ($query) {
          $query->select('image_location', 'news_content_id');
        },
      ])
      ->where('language', app()->getLocale())
      ->orderBy('created_at', 'desc')
      ->get();
    return view('news.index', compact('news'));
  }

  public function indexAdmin()
  {
    $news = NewsContent::select('id', 'title')
      ->where('language', Lang::locale())
      ->orderBy('created_at', 'desc')
      ->get();
    return view('admin.news.index', compact('news'));
  }

  public function create()
  {
    return view('admin.news.create');
  }

  public function store(StoreNewsRequest $data, NewsService $newsService)
  {
    try {
      $newsService->addNews($data);
      $newsService->addImage($data['news-images']);
      if ($data->has('news-attachments')) {
        $newsService->addAttachment($data['news-attachments']);
      }
      return redirect('/admin/news')->with('success', 'Jaunums pievienots');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function show($language, NewsContent $news)
  {
    $newsItem = NewsContent::select('id', 'title', 'content', 'slug')
      ->with([
        'newsImages' => function ($query) {
          $query->select('image_location', 'news_content_id');
        },
        'newsAttachments' => function ($query) {
          $query->select('attachment_location', 'news_content_id');
        },
      ])
      ->where('language', $language)
      ->findOrFail($news->id);
    return view('news.show', compact('newsItem'));
  }

  public function showAdmin(NewsContent $news)
  {
    return view('admin.news.edit', compact('news'));
  }

  public function destroyNewsImage(NewsImage $newsImage)
  {
    try {
      $newsImage->delete();
      Storage::disk('public')->delete('news/'.Str::slug($newsImage->newsContent->title).'/'.$newsImage->image_location);
      return redirect()->to(app('url')->previous()."#news-images")->with('success', 'Bilde dzēsta!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroyNewsAttachment(NewsAttachment $newsAttachment)
  {
    try {
      $newsAttachment->delete();
      Storage::disk('public')->delete('news/'.Str::slug($newsAttachment->newsContent->title).'/'.$newsAttachment->attachment_location);
      return redirect()->to(app('url')->previous()."#news-attachments")->with('success', 'Pielikums dzēsts!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function update(Request $data)
  {
    try {
      $newsToUpdate = NewsContent::findOrFail($data->id);
      if ($data['news-title'] !== $newsToUpdate->title) {
        $newProductVariantImageDirectory = 'news/'.Str::slug($data['news-title']);
        $oldProductVariantImageDirectory = 'news/'.Str::slug($newsToUpdate->title);
        Storage::disk('public')->makeDirectory($newProductVariantImageDirectory);
        Storage::disk('public')->move($oldProductVariantImageDirectory, $newProductVariantImageDirectory);
      }
      $newsToUpdate->update([
        'title' => $data['news-title'],
        'slug' => Str::slug($data['news-title']),
        'content' => $data['news-content']
      ]);
      if (isset($data['news-images-attachments'])) {
        $this->saveNewsImagesAttachments($data, $newsToUpdate);
      }
      return redirect('/admin/news')->with('success', 'Jaunums atjaunināts!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(NewsContent $news)
  {
    try {
      Storage::disk('public')->deleteDirectory('news/'.$news->slug);
      $news->delete();
      return redirect('/admin/news')->with('success', 'Jaunums dzēsts!');
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  protected function saveNewsImagesAttachments(Request $data, $newsToUpdate): void
  {
    foreach ($data['news-images-attachments'] as $newsImageAttachment) {
      $fileName = basename($newsImageAttachment);
      Storage::disk('public')->move($newsImageAttachment, 'news/'.Str::slug($data['news-title']).'/'.$fileName);
      if (pathinfo($newsImageAttachment)['extension'] === 'pdf') {
        $newsToUpdate->newsAttachments()->create([
          'attachment_location' => $fileName
        ]);
      } else {
        $newsToUpdate->newsImages()->create([
          'image_location' => $fileName
        ]);
      }
    }
  }
}
