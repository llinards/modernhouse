<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductVariantOptionUpdate extends Component
{
  /**
   * Create a new component instance.
   *
   * @param $key
   * @param $productVariantOption
   */
  public function __construct(public $key, public $productVariantOption, public $productVariant)
  {
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.product-variant-option-update');
  }
}
