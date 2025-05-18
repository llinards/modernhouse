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
          $query->select('name', 'product_id', 'language')->where('language', app()->getLocale());
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
