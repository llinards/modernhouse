<?php

namespace App\Livewire\Admin;

use App\Http\Services\ProductVariantService;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantImage;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductVariantImageList extends Component
{
  public Product $product;
  public ProductVariant $productVariant;

  public function updateOrder($images): void
  {
    foreach ($images as $image) {
      ProductVariantImage::findOrFail($image['value'])->update(['order' => $image['order']]);
    }

    $this->mount($this->product, $this->productVariant);
    session()->flash('success', 'Galerijas secība atjaunota');
  }

  public function deleteImage(ProductVariantImage $image, ProductVariantService $productVariantService): void
  {
    try {
      $productVariantService->destroyImage($image);
      $this->mount($this->product, $this->productVariant);
      session()->flash('success', 'Bilde dzēsta');
    } catch (\Exception $e) {
      Log::error($e);
      session()->flash('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function mount(Product $product, ProductVariant $productVariant): void
  {
    $this->product = $product;
    $this->productVariant = $productVariant;
  }

  public function render()
  {
    return view('livewire.admin.product-variant-image-list');
  }
}
