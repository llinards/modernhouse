<?php

namespace App\Livewire\Admin;

use App\Http\Services\ProductVariantService;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPlan;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductVariantPlanList extends Component
{
  public Product $product;
  public ProductVariant $productVariant;
  public $productVariantPlan;

  public function deletePlan(ProductVariantPlan $plan, ProductVariantService $productVariantService): void
  {
    try {
      $productVariantService->destroyPlan($plan);
      $this->mount($this->product, $this->productVariant);
      session()->flash('success', 'Plāns dzēsts');
    } catch (\Exception $e) {
      Log::error($e);
      session()->flash('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function mount(Product $product, ProductVariant $productVariant): void
  {
    $this->product            = $product;
    $this->productVariant     = $productVariant;
    $this->productVariantPlan = ProductVariantPlan::where('product_variant_id', $this->productVariant->id)
                                                  ->where('language', app()->getLocale())
                                                  ->get();
  }

  public function render()
  {
    return view('livewire.admin.product-variant-plan-list');
  }
}
