<?php

namespace App\View\Composers;

use App\Models\PromoModal;
use Illuminate\View\View;

class PromoModalComposer
{
  public function compose(View $view): void
  {
    $promoModal = PromoModal::current();

    $view->with(
      'promoModal',
      ($promoModal->shouldDisplay() && app()->getLocale() === 'lv') ? $promoModal : null
    );
  }
}
