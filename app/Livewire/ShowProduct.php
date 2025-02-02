<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Component;

class ShowProduct extends Component
{
  public Product $product;
  public ProductVariant|string $productVariant;
  public object $productVariants;

  public function mount(Product $product, string $productVariant = '')
  {
    $this->product         = $this->getProduct($product);
    $this->productVariants = $this->getProductVariants($this->product);
    if (count($this->productVariants) > 0) {
      if ($productVariant) {
        $this->productVariant = $this->getProductVariant($productVariant);
      } else {
        $this->productVariant = $this->getFirstProductVariant();
      }
    }
  }

  public function render()
  {
    return view('livewire.show-product')
      ->layout('components.layouts.app')
      ->title($this->product->translations[0]->name);
  }

  private function getFirstProductVariant()
  {
    return $this->productVariants->first();
  }

  private function getProductVariant(string $productVariant)
  {
    return $this->productVariants->where('slug', $productVariant)->first() ?? abort(404);
  }

  private function getProduct(Product $product)
  {
    return Product::select('id', 'slug')
                  ->with([
                    'translations' => function ($query) {
                      $query->select('name', 'product_id')->where('language', app()->getLocale());
                    },
                  ])
                  ->whereHas('translations', function ($query) {
                    $query->where('language', app()->getLocale());
                  })
                  ->where('is_active', 1)
                  ->findOrFail($product->id);
  }

  private function getProductVariants(Product $product)
  {
    return ProductVariant::select('id', 'product_id', 'slug', 'price_basic', 'price_middle', 'price_full',
      'living_area',
      'building_area')
                         ->with([
                           'translations' => function ($query) {
                             $query->select('product_variant_id', 'name', 'description')->where('language',
                               app()->getLocale());
                           },
                         ])
                         ->with([
                           'productVariantImages' => function ($query) {
                             $query->select('product_variant_id', 'filename');
                           },
                         ])
                         ->with([
                           'productVariantDetails' => function ($query) {
                             $query->select('product_variant_id', 'name', 'hasThis', 'icon', 'count')->where('language',
                               app()->getLocale());
                           },
                         ])
                         ->with([
                           'productVariantOptions' => function ($query) {
                             $query->select('id', 'product_variant_id', 'option_title')->where('language',
                               app()->getLocale())
                                   ->with([
                                     'productVariantOptionDetails' => function ($query) {
                                       $query->select('product_variant_option_id', 'detail', 'has_in_basic',
                                         'has_in_middle',
                                         'has_in_full');
                                     },
                                   ]);
                           },
                         ])
                         ->with([
                           'productVariantAttachments' => function ($query) {
                             $query->select('product_variant_id', 'filename', 'language')->where('language',
                               app()->getLocale());
                           },
                         ])
                         ->with([
                           'productVariantPlan' => function ($query) {
                             $query->select('product_variant_id', 'filename')->where('language', app()->getLocale());
                           },
                         ])
                         ->whereHas('translations', function ($query) {
                           $query->where('language', app()->getLocale());
                         })
                         ->where('is_active', 1)
                         ->where('product_id', $product->id)
                         ->orderBy('slug')
                         ->get();
  }
}
