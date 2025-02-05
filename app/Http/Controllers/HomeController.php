<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Mail\ConsultationSubmitted;
use App\Mail\ContactUsSubmitted;
use App\Mail\RequestedProductInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
  //TODO:check why the first paramter is required to be $language
  public function requestProductInfo($language, ContactUsRequest $request)
  {
    try {
//      $klaviyoService->storeProfile($request, config('klaviyo.list_id_request_product_info'));
      Mail::to('info@modern-house.ie')->send(new RequestedProductInfo($request->input()));

      return back()->with('success', Lang::get('message has been sent'));
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', Lang::get('message has not been sent'));
    }
  }

  public function submitContactUs(ContactUsRequest $data)
  {
    try {
      Mail::to('info@modern-house.ie')->send(new ContactUsSubmitted($data->input()));

      return Redirect::to(URL::previous()."#contact-us")->with('success', Lang::get('message has been sent'));
    } catch (\Exception $e) {
      Log::error($e);

      return Redirect::to(URL::previous()."#contact-us")->with('error', Lang::get('message has not been sent'));
    }
  }

  public function submitConsultation(ContactUsRequest $data)
  {
    try {
//      $klaviyoService->storeProfile($request, config('klaviyo.list_id_request_consultation'));
      Mail::to('info@modern-house.ie')->send(new ConsultationSubmitted($data->input()));

      return back()->with('success', Lang::get('message has been sent'));
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', Lang::get('message has not been sent'));
    }
  }

  public function storeTemporaryUpload(Request $data): string
  {
    $fileTypes = [
      'product-cover-photo', 'product-cover-video', 'product-variant-images', 'gallery-images', 'news-images',
      'news-attachments', 'product-variant-attachments', 'product-variant-options-excel', 'product-variant-plan',
    ];
    foreach ($fileTypes as $fileType) {
      if ($data->hasFile($fileType)) {
        $files = $data->file($fileType);
        foreach ($files as $file) {
          if ($fileType === 'product-cover-photo') {
            $fileName = 'cover.'.$file->getClientOriginalExtension();
          } else {
            $fileName = $file->getClientOriginalName();
          }

          return $file->storeAs('uploads/temp', $fileName, 'public');
        }
      }
    }

    return '';
  }

  public function destroyTemporaryUpload(Request $data): string
  {
    Storage::delete('public/'.$data->getContent());

    return '';
  }
}
