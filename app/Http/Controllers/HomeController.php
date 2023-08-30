<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Http\Services\KlaviyoService;
use App\Mail\ContactUsSubmitted;
use App\Mail\RequestedProductInfo;
use App\Models\GalleryContent;
use App\Models\NewsContent;
use App\Models\Product;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
  public function index()
  {
    $allProducts = Product::activeProducts()->get();
    return view('home')->with('allProducts', $allProducts);
  }

  //TODO:check why the first paramter is required to be $language
  public function show($language, Product $product)
  {
    $allProducts = Product::activeProducts()->get();
    return view('product')->with('product', $product)->with('allProducts', $allProducts);
  }

  //TODO:check why the first paramter is required to be $language
  public function requestProductInfo($language, ContactUsRequest $request, KlaviyoService $klaviyoService)
  {
    try {
      $profileId = $klaviyoService->createProfile($request);
      if ($profileId) {
        $klaviyoService->subscribeProfile($profileId, 'XpkjqM', $request);
      }
      Mail::to('info@modern-house.lv')->send(new RequestedProductInfo($request->input()));
      return back()->with('success', Lang::get('message has been sent'));
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', Lang::get('message has not been sent'));
    }
  }

  public function contactUs()
  {
    return view('contact-us')->with('allProducts', $this->getAllActiveProducts());
  }

  public function submitContactUs(ContactUsRequest $data)
  {
    try {
      Mail::to('info@modern-house.lv')->send(new ContactUsSubmitted($data->input()));
      return back()->with('success', Lang::get('message has been sent'));
    } catch (\Exception $e) {
      Log::debug($e);
      return back()->with('error', Lang::get('message has not been sent'));
    }
  }

  public function aboutUs()
  {
    return view('about-us')->with('allProducts', $this->getAllActiveProducts());
  }

  public function privacyPolicy()
  {
    return view('privacy-policy')->with('allProducts', $this->getAllActiveProducts());
  }

  public function gallery()
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
      ->orderBy('created_at', 'desc')
      ->get();
    return view('gallery')->with('galleryContents', $galleryContents)->with('allProducts',
      $this->getAllActiveProducts());
  }

  public function newsIndex()
  {
    $newsContent = NewsContent::where('language', app()->getLocale())->orderBy('created_at', 'desc')->get();
    return view('news-index')->with('newsContent', $newsContent)->with('allProducts', $this->getAllActiveProducts());
  }

  //TODO:check why the first paramter is required to be $language
  public function newsShow($language, NewsContent $newsContent)
  {
    return view('news-show')->with('newsContent', $newsContent)->with('allProducts', $this->getAllActiveProducts());
  }

  protected function getAllActiveProducts()
  {
    return Product::where('is_active', true)->get();
  }
}
