<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Component;

class Gallery extends Component
{
  public Product $product;
  public ProductVariant $productVariant;

  public function render()
  {
    return view('livewire.product.gallery');
  }
}
