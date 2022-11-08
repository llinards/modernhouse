<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductInfoRequest;
use App\Mail\RequestedProductInfo;
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

    public function requestProductInfo(ProductInfoRequest $request)
    {
      try {
        Mail::to('info@modern-house.lv')->send(new RequestedProductInfo($request->input()));
        return back()->with('success', Lang::get('message has been sent'));
      } catch (\Exception $e) {
        return back()->with('error', Lang::get('message has not been sent'));
      }
    }
}
