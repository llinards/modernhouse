<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Jobs\SyncProfileToKlaviyo;
use App\Mail\ContactUsSubmitted;
use App\Mail\RequestedProductInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
  public function requestProductInfo(string $language, ContactUsRequest $request): RedirectResponse
  {
    try {
      Mail::to(config('mail.contact_email'))->send(new RequestedProductInfo($request->validated()));
      SyncProfileToKlaviyo::dispatch($request->validated(), config('klaviyo.list_id_request_product_info'), 'Produkta pieprasījums');

      return back()->with('success', Lang::get('message has been sent'));
    } catch (\Exception $e) {
      report($e);

      return back()->with('error', Lang::get('message has not been sent'));
    }
  }

  public function submitContactUs(ContactUsRequest $request): RedirectResponse
  {
    try {
      Mail::to(config('mail.contact_email'))->send(new ContactUsSubmitted($request->validated()));

      return back()->with('success', Lang::get('message has been sent'));
    } catch (\Exception $e) {
      report($e);

      return back()->with('error', Lang::get('message has not been sent'));
    }
  }

  public function submitConsultation(ContactUsRequest $request): RedirectResponse
  {
    SyncProfileToKlaviyo::dispatch($request->validated(), config('klaviyo.list_id_request_consultation'), 'Konsultācijas pieprasījums');

    return back()->with('success', Lang::get('message has been sent'));
  }
}
