<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Services\NewsService;
use App\Models\NewsAttachment;
use App\Models\NewsContent;
use App\Models\NewsImage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

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
      if ($e->getCode() === '23000') {
        return back()->with('error', 'Kļūda! Šāds nosaukums jau eksistē.');
      }
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

  public function update(UpdateNewsRequest $data, NewsService $newsService)
  {
    try {
      $newsService->updateNews($data);
      if ($data->has('news-images')) {
        $newsService->addImage($data['news-images']);
      }
      if ($data->has('news-attachments')) {
        $newsService->addAttachment($data['news-attachments']);
      }
      return redirect('/admin/news')->with('success', 'Jaunums atjaunināts!');
    } catch (\Exception $e) {
      if ($e->getCode() === '23000') {
        return back()->with('error', 'Kļūda! Šāds nosaukums jau eksistē.');
      }
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(NewsContent $news, NewsService $newsService)
  {
    try {
      $newsService->destroyNews($news);
      return redirect('/admin/news')->with('success', 'Jaunums dzēsts!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroyNewsImage(NewsImage $image, NewsService $newsService)
  {
    try {
      $newsService->destroyImage($image);
      return redirect()->to(app('url')->previous()."#news-images")->with('success', 'Bilde dzēsta!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroyNewsAttachment(NewsAttachment $attachment, NewsService $newsService)
  {
    try {
      $newsService->destroyAttachment($attachment);
      return redirect()->to(app('url')->previous()."#news-attachments")->with('success', 'Pielikums dzēsts!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
