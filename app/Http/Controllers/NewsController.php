<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Services\NewsService;
use App\Models\News;
use App\Models\NewsAttachment;
use App\Models\NewsImage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
  public function index()
  {
    $allNews = News::select('id', 'title', 'slug')
      ->with([
        'images' => function ($query) {
          $query->select('image_location', 'news_id');
        },
      ])
      ->where('language', app()->getLocale())
      ->orderBy('created_at', 'desc')
      ->get();
    return view('news.index', compact('allNews'));
  }

  public function indexAdmin()
  {
    $allNews = News::select('id', 'title')
      ->where('language', Lang::locale())
      ->orderBy('created_at', 'desc')
      ->paginate(12);
    return view('admin.news.index', compact('allNews'));
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

  public function show($language, News $news)
  {
    $news = News::select('id', 'title', 'content', 'slug')
      ->with([
        'images' => function ($query) {
          $query->select('image_location', 'news_id');
        },
        'attachments' => function ($query) {
          $query->select('attachment_location', 'news_id');
        },
      ])
      ->where('language', $language)
      ->findOrFail($news->id);
    return view('news.show', compact('news'));
  }

  public function showAdmin(News $news)
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

  public function destroy(News $news, NewsService $newsService)
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
      return redirect()->to(app('url')->previous()."#all-news-images")->with('success', 'Bilde dzēsta!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroyNewsAttachment(NewsAttachment $attachment, NewsService $newsService)
  {
    try {
      $newsService->destroyAttachment($attachment);
      return redirect()->to(app('url')->previous()."#all-news-attachments")->with('success', 'Pielikums dzēsts!');
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
