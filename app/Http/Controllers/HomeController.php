<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUsSubmitted;
use App\Mail\RequestedProductInfo;
use App\Models\GalleryContent;
use App\Models\NewsContent;
use App\Models\Product;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
  public function index()
  {
    return view('home')->with('allProducts', $this->getAllActiveProducts());
  }

  public function show(Product $product)
  {
    return view('product')->with('product', $product)->with('allProducts', $this->getAllActiveProducts());
  }

  public function requestProductInfo(ContactUsRequest $request)
  {
    try {
      Mail::to('info@modern-house.lv')->send(new RequestedProductInfo($request->input()));
      return back()->with('success', Lang::get('message has been sent'));
    } catch (\Exception $e) {
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
    $galleryContent = GalleryContent::with('galleryImages')->get();
    return view('gallery')->with('galleryContent', $galleryContent)->with('allProducts', $this->getAllActiveProducts());
  }

  public function news()
  {
    $newsContent = NewsContent::get();
    return view('news')->with('newsContent', $newsContent)->with('allProducts', $this->getAllActiveProducts());
  }

  protected function getAllActiveProducts()
  {
    return Product::where('is_active', true)->get();
  }
}
