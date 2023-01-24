<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUsSubmitted;
use App\Mail\RequestedProductInfo;
use App\Models\GalleryContent;
use App\Models\NewsContent;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
      $allProducts = Product::where('is_active', true)->get();
      return view('home', compact('allProducts'));
    }

    public function show(Product $product)
    {
      $allProducts = Product::where('is_active', true)->get();
      return view('product', compact('product', 'allProducts'));
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
      $allProducts = Product::where('is_active', true)->get();
      return view('contact-us', compact('allProducts'));
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
      $allProducts = Product::where('is_active', true)->get();
      return view('about-us', compact('allProducts'));
    }

    public function gallery()
    {
      $allProducts = Product::where('is_active', true)->get();
      $galleryContent = GalleryContent::with('galleryImages')->get();
      return view('gallery', compact('galleryContent', 'allProducts'));
    }

    public function news()
    {
      $allProducts = Product::where('is_active', true)->get();
      $newsContent = NewsContent::get();
      return view('news', compact('newsContent', 'allProducts'));
    }
}
