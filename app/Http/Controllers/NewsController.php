<?php

namespace App\Http\Controllers;

use App\Models\NewsAttachment;
use App\Models\NewsContent;
use App\Models\NewsImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{

  public function index()
  {
    $allNewsContent = NewsContent::where('language', Lang::locale())->get();
    return view('admin.news.index', compact('allNewsContent'));
  }

  public function create()
  {
    return view('admin.news.create');
  }

  public function store(Request $data)
  {
    try {
      $newNewsContent = NewsContent::create([
        'title' => $data['news-title'],
        'slug' => Str::slug($data['news-title']),
        'content' => $data['news-content'],
        'language' => $data['news-language'],
      ]);
      foreach ($data['news-images-attachments'] as $newsImageAttachment) {
        $fileName = basename($newsImageAttachment);
        Storage::disk('public')->move($newsImageAttachment, 'news/' . Str::slug($data['news-title']) . '/' . $fileName);
        if (pathinfo($newsImageAttachment)['extension'] === 'pdf') {
          $newNewsContent->newsAttachments()->create([
            'attachment_location' => $fileName
          ]);
        } else {
          $newNewsContent->newsImages()->create([
            'image_location' => $fileName
          ]);
        }
      }
      return redirect('/admin/news')->with('success', 'Jaunums pievienots');
    } catch (\Exception $e) {
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function show(NewsContent $news)
  {
    return view('admin.news.edit', compact('news'));
  }

  public function destroyNewsImage(NewsImage $newsImage)
  {
    try {
      $newsImage->delete();
      Storage::disk('public')->delete('news/' . Str::slug($newsImage->newsContent->title) . '/' . $newsImage->image_location);
      return redirect()->to(app('url')->previous() . "#news-images")->with('success', 'Bilde dzēsta!');
    } catch (\Exception $e) {
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroyNewsAttachment(NewsAttachment $newsAttachment)
  {
    try {
      $newsAttachment->delete();
      Storage::disk('public')->delete('news/' . Str::slug($newsAttachment->newsContent->title) . '/' . $newsAttachment->attachment_location);
      return redirect()->to(app('url')->previous() . "#news-attachments")->with('success', 'Pielikums dzēsts!');
    } catch (\Exception $e) {
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function update(Request $data)
  {
    try {
      $newsToUpdate = NewsContent::findOrFail($data->id);
      if ($data['news-title'] !== $newsToUpdate->title) {
        $newProductVariantImageDirectory = 'news/' . Str::slug($data['news-title']);
        $oldProductVariantImageDirectory = 'news/' . Str::slug($newsToUpdate->title);
        Storage::disk('public')->makeDirectory($newProductVariantImageDirectory);
        Storage::disk('public')->move($oldProductVariantImageDirectory, $newProductVariantImageDirectory);
      }
      $newsToUpdate->update([
        'title' => $data['news-title'],
        'slug' => Str::slug($data['news-title']),
        'content' => $data['news-content']
      ]);
      if (isset($data['news-images-attachments'])) {
        foreach ($data['news-images-attachments'] as $newsImageAttachment) {
          $fileName = basename($newsImageAttachment);
          Storage::disk('public')->move($newsImageAttachment, 'news/' . Str::slug($data['news-title']) . '/' . $fileName);
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
      return redirect('/admin/news')->with('success', 'Jaunums atjaunināts!');
    } catch (\Exception $e) {
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function destroy(NewsContent $news)
  {
    try {
      Storage::disk('public')->deleteDirectory('news/' . Str::slug($news['title']));
      $news->delete();
      return redirect('/admin/news')->with('success', 'Jaunums dzēsts!');
    } catch (\Exception $e) {
      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
