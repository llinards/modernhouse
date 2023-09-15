<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Http\Services\KlaviyoService;
use App\Mail\ContactUsSubmitted;
use App\Mail\RequestedProductInfo;
use App\Models\Product;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
  //TODO:check why the first paramter is required to be $language
  public function show($language, Product $product)
  {
    return view('product')->with('product', $product);
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

  public function requestConsultation()
  {
    return view('request-consultation')->with('allProducts', $this->getAllActiveProducts());
  }

  public function submitConsultation(ContactUsRequest $data, KlaviyoService $klaviyoService)
  {
    try {
      $profileId = $klaviyoService->createProfile($data);
      if ($profileId) {
        $klaviyoService->subscribeProfile($profileId, 'W3jiWs', $data);
      }
      return back()->with('success', Lang::get('message has been sent'));
    } catch (\Exception $e) {
      Log::error($e);
      return back()->with('error', Lang::get('message has not been sent'));
    }
  }
}
