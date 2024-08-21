<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
  public object $products;

  public function updateOrder($products): void
  {
    foreach ($products as $product) {
      Product::findOrFail($product['value'])->update(['order' => $product['order']]);
    }
//    Nav autorefresh
    session()->flash('success', 'Secība atjaunota.');
    $this->mount($this->products);
  }

  public function mount(object $products): void
  {
    $this->products = $products;
  }

  public function render()
  {
    return view('livewire.admin.product-list');
  }
}
