<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowProduct extends Component
{
  public Product $product;
  public ProductVariant $selectedVariant;
  public string $productVariantSlug;

  #[Locked]
  public array $variantTabs = [];

  private Collection $productVariants;

  public function mount(Product $product, string $productVariant = ''): void
  {
    $locale = app()->getLocale();

    $this->product = Product::select('id', 'slug', 'cover_photo_filename', 'cover_video_filename')
      ->with([
        'translations' => fn ($query) => $query->select('name', 'product_id')->where('language', $locale),
      ])
      ->whereHas('translations', fn ($query) => $query->where('language', $locale))
      ->where('is_active', 1)
      ->findOrFail($product->id);

    $this->productVariants = ProductVariant::select('id', 'product_id', 'slug', 'price_basic', 'price_middle', 'price_full', 'living_area', 'building_area')
      ->with([
        'translations' => fn ($query) => $query->select('product_variant_id', 'name', 'description')->where('language', $locale),
        'productVariantImages' => fn ($query) => $query->select('product_variant_id', 'filename'),
      ])
      ->whereHas('translations', fn ($query) => $query->where('language', $locale))
      ->where('is_active', 1)
      ->where('product_id', $this->product->id)
      ->orderBy('slug')
      ->get();

    if ($this->productVariants->isEmpty()) {
      abort(404);
    }

    $this->variantTabs = $this->productVariants->map(fn ($v) => [
      'slug' => $v->slug,
      'name' => $v->translations->first()->name,
    ])->all();

    $this->selectedVariant = $productVariant
      ? $this->productVariants->where('slug', $productVariant)->first() ?? abort(404)
      : $this->productVariants->first();

    $this->loadVariantRelationships($locale);
    $this->productVariantSlug = $this->selectedVariant->slug;
  }

  public function render(): View
  {
    return view('livewire.show-product')
      ->layout('components.layouts.app', [
        'header' => $this->product->translations[0]->name,
      ]);
  }

  public function switchProductVariant(string $productVariantSlug): void
  {
    $locale = app()->getLocale();

    $this->selectedVariant = ProductVariant::select('id', 'product_id', 'slug', 'price_basic', 'price_middle', 'price_full', 'living_area', 'building_area')
      ->with([
        'translations' => fn ($query) => $query->select('product_variant_id', 'name', 'description')->where('language', $locale),
        'productVariantImages' => fn ($query) => $query->select('product_variant_id', 'filename'),
        'productVariantDetails' => fn ($query) => $query->select('product_variant_id', 'name', 'hasThis', 'icon', 'count')->where('language', $locale),
        'productVariantOptions' => fn ($query) => $query->select('id', 'product_variant_id', 'option_title')->where('language', $locale)
          ->with([
            'productVariantOptionDetails' => fn ($query) => $query->select('product_variant_option_id', 'detail', 'has_in_basic', 'has_in_middle', 'has_in_full'),
          ]),
        'productVariantAttachments' => fn ($query) => $query->select('product_variant_id', 'filename', 'language')->where('language', $locale),
        'productVariantPlan' => fn ($query) => $query->select('product_variant_id', 'filename')->where('language', $locale),
      ])
      ->where('slug', $productVariantSlug)
      ->where('product_id', $this->product->id)
      ->where('is_active', 1)
      ->firstOrFail();

    $this->productVariantSlug = $this->selectedVariant->slug;

    $this->dispatch('update-url', url: '/' . app()->getLocale() . '/' . $this->product->slug . '/' . $this->productVariantSlug);
    $this->dispatch('variantChanged', $productVariantSlug);
  }

  private function loadVariantRelationships(string $locale): void
  {
    $this->selectedVariant->loadMissing([
      'productVariantDetails' => fn ($query) => $query->select('product_variant_id', 'name', 'hasThis', 'icon', 'count')->where('language', $locale),
      'productVariantOptions' => fn ($query) => $query->select('id', 'product_variant_id', 'option_title')->where('language', $locale)
        ->with([
          'productVariantOptionDetails' => fn ($query) => $query->select('product_variant_option_id', 'detail', 'has_in_basic', 'has_in_middle', 'has_in_full'),
        ]),
      'productVariantAttachments' => fn ($query) => $query->select('product_variant_id', 'filename', 'language')->where('language', $locale),
      'productVariantPlan' => fn ($query) => $query->select('product_variant_id', 'filename')->where('language', $locale),
    ]);
  }
}
