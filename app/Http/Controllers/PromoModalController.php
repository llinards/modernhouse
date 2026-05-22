<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePromoModalRequest;
use App\Http\Services\PromoModalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PromoModalController extends Controller
{
  public function update(UpdatePromoModalRequest $request, PromoModalService $promoModalService): RedirectResponse
  {
    try {
      $promoModalService->update($request->validated());

      return back()->with('success', 'Reklāmas logs veiksmīgi atjaunots!');
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
