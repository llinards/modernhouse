<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;

class LandingPageController extends Controller
{
  public function sviresIelasProjektsSigulda($language)
  {
    if ($language === 'lv') {
      $productVariantId = 29;
      $productVariant   = ProductVariant::select('id', 'slug')
                                        ->with([
                                          'productVariantOptions' => function ($query) {
                                            $query->select('id', 'product_variant_id',
                                              'option_title')->where('language',
                                              app()->getLocale())
                                                  ->with([
                                                    'productVariantOptionDetails' => function ($query) {
                                                      $query->select('product_variant_option_id', 'detail',
                                                        'has_in_basic',
                                                        'has_in_middle',
                                                        'has_in_full');
                                                    },
                                                  ]);
                                          },
                                        ])
                                        ->findOrFail($productVariantId);

      return view('landing-pages.svires-ielas-projekts-sigulda', compact('productVariant'));
    }
    abort(404);
  }
}
