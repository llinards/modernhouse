<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class ShowProduct extends Component
{
  public Product $product;
  public ProductVariant|string $productVariant;
  public object $productVariants;
  public string $productVariantSlug;

  public function mount(Product $product, string $productVariant = ''): void
  {
    $this->product         = $this->getProduct($product);
    $this->productVariants = $this->getProductVariants($this->product);
    if ($this->productVariants->isNotEmpty()) {
      $this->productVariant = $productVariant
        ? $this->getProductVariant($productVariant)
        : $this->productVariants->first();
    } else {
      abort(404);
    }
  }

  public function render(): View
  {
    return view('livewire.show-product')
      ->layout('components.layouts.app', [
        'header' => $this->product->translations[0]->name,
      ]);
  }

  public function switchProductVariant(string $productVariant): void
  {
    $this->productVariant = ProductVariant::select('id', 'product_id', 'slug', 'price_basic', 'price_middle',
      'price_full',
      'living_area',
      'building_area')
                                          ->with([
                                            'translations' => function ($query) {
                                              $query->select('product_variant_id', 'name',
                                                'description')->where('language',
                                                app()->getLocale());
                                            },
                                          ])
                                          ->with([
                                            'productVariantDetails' => function ($query) {
                                              $query->select('product_variant_id', 'name', 'hasThis', 'icon',
                                                'count')->where('language',
                                                app()->getLocale());
                                            },
                                          ])
                                          ->with([
                                            'productVariantOptions' => function ($query) {
                                              $query->select('id', 'product_variant_id',
                                                'option_title')->where('language',
                                                app()->getLocale())
                                                    ->with([
                                                      'productVariantOptionDetails' => function ($query) {
                                                        $query->select('product_variant_option_id', 'detail',
                                                          'has_in_basic',
                                                          'has_in_middle',
                                                          'has_in_full');
                                                      },
                                                    ]);
                                            },
                                          ])
                                          ->with([
                                            'productVariantAttachments' => function ($query) {
                                              $query->select('product_variant_id', 'filename',
                                                'language')->where('language',
                                                app()->getLocale());
                                            },
                                          ])
                                          ->with([
                                            'productVariantPlan' => function ($query) {
                                              $query->select('product_variant_id', 'filename')->where('language',
                                                app()->getLocale());
                                            },
                                          ])
                                          ->where('slug', $productVariant)
                                          ->firstOrFail();

    $this->productVariantSlug = $this->productVariant->slug;
    $this->dispatch('update-url', url: '/'.app()->getLocale().'/'.$this->product->slug.'/'.$this->productVariantSlug);
  }

  private function getProduct(Product $product): Product
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

  private function getProductVariant(string $productVariantSlug): ProductVariant
  {
    return $this->productVariants->where('slug', $productVariantSlug)->first() ?? abort(404);
  }

  private function getProductVariants(Product $product): Collection
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
