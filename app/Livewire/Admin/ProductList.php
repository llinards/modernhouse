<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
  public object $products;

  public function updateOrder(array $products): void
  {
    foreach ($products as $product) {
      Product::findOrFail($product['value'])->update(['order' => $product['order']]);
    }
    $this->mount();
    session()->flash('success', 'Secība atjaunota.');
  }

  public function mount(): void
  {
    $this->products = Product::select('id', 'slug', 'cover_photo_filename', 'cover_video_filename', 'is_active')
                             ->with([
                               'translations' => function ($query) {
                                 $query->select('name', 'product_id', 'language')->where('language',
                                   app()->getLocale());
                               },
                             ])
                             ->with([
                               'productVariants' => function ($query) {
                                 $query->select('id', 'product_id', 'slug', 'is_active')->orderBy('slug');
                                 $query->with([
                                   'translations' => function ($query) {
                                     $query->select('product_variant_id', 'name', 'language')->where('language',
                                       app()->getLocale());
                                   },
                                 ]);
                               },
                             ])
                             ->get();
  }

  public function render()
  {
    return view('livewire.admin.product-list');
  }
}
