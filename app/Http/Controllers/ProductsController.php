<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductInfoRequest;
use App\Mail\RequestedProductInfo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class ProductsController extends Controller
{
    public function index()
    {
      $allProducts = Product::all();
      return view('home', compact('allProducts'));
    }

    public function show(Product $product)
    {
      return view('product', compact('product'));
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
