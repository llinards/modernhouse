<?php

namespace App\View\Composers;

use App\Models\Product;
use Illuminate\View\View;

class AllActiveProductsComposer
{
  public function compose(View $view): void
  {
    $allActiveProducts = Product::select('id', 'slug')
                                ->with([
                                  'translations' => function ($query) {
                                    $query->select('name', 'product_id', 'language')->where('language',
                                      app()->getLocale());
                                  },
                                ])
                                ->with([
                                  'productVariants' => function ($query) {
                                    $query->select('id', 'is_active', 'product_id', 'slug', 'menu_icon')
                                          ->with([
                                            'translations' => function ($query) {
                                              $query->select('product_variant_id', 'name')->where('language',
                                                app()->getLocale());
                                            },
                                          ])->where('is_active', true);
                                  },
                                ])
                                ->whereHas('translations', function ($query) {
                                  $query->where('language', app()->getLocale());
                                })
                                ->where('is_active', true)
                                ->get();

    $view->with('allActiveProducts', $allActiveProducts);
  }
}
