<?php

namespace App\Livewire\Admin;

use App\Models\ProductVariant;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use Livewire\Component;

class ProductVariantOptionList extends Component
{
  public ProductVariant $productVariant;
  public object $productVariantOptions;

  public function updateProductVariantOptionOrder(array $productVariantOptions): void
  {
    foreach ($productVariantOptions as $productVariantOption) {
      ProductVariantOption::findOrFail($productVariantOption['value'])->update(['order' => $productVariantOption['order']]);
    }
    $this->mount($this->productVariant);
    session()->flash('success', 'Secība atjaunota.');
  }

  public function updateProductVariantOptionDetailOrder(array $productVariantOptionDetails): void
  {
    foreach ($productVariantOptionDetails as $productVariantOptionDetail) {
      ProductVariantOption::findOrFail($productVariantOptionDetail['value'])->update(['order' => $productVariantOptionDetail['order']]);
      foreach ($productVariantOptionDetail['items'] as $detail) {
        ProductVariantOptionDetail::findOrFail($detail['value'])->update(['order' => $detail['order']]);
      }
    }
    $this->mount($this->productVariant);
    session()->flash('success', 'Secība atjaunota.');
  }

  public function mount(ProductVariant $productVariant): void
  {
    $this->productVariant        = $productVariant;
    $this->productVariantOptions = ProductVariantOption::where('product_variant_id', $this->productVariant->id)
                                                       ->where('language', app()->getLocale())
                                                       ->get();
  }

  public function render()
  {
    return view('livewire.admin.product-variant-option-list');
  }
}

