<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;

class LandingPageController extends Controller
{
  private function landingPageProducts()
  {

  }

  public function sviresIelasProjektsSigulda($language)
  {
    $productVariantId = 29;
    $productVariant = ProductVariant::select('id', 'slug')
      ->with([
        'productVariantOptions' => function ($query) {
          $query->select('product_variant_id', 'option_title', 'option_category', 'options')
            ->where('language', app()->getLocale());
        }
      ])
      ->findOrFail($productVariantId);
    return view('landing-pages.svires-ielas-projekts-sigulda', compact('productVariant'));
  }
}