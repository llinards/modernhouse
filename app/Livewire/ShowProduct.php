<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowProduct extends Component
{
  #[Locked]
  public ?int $productId = null;

  #[Locked]
  public ?int $selectedVariantId = null;

  #[Locked]
  public string $productVariantSlug = '';

  #[Locked]
  public array $variantTabs = [];

  public function mount(Product $product, string $productVariant = ''): void
  {
    $locale = app()->getLocale();

    $validProduct = Product::select('id', 'slug')
      ->whereHas('translations', fn ($query) => $query->where('language', $locale))
      ->where('is_active', 1)
      ->findOrFail($product->id);

    $this->productId = $validProduct->id;

    $productVariants = ProductVariant::select('id', 'product_id', 'slug')
      ->with([
        'translations' => fn ($query) => $query->select('product_variant_id', 'name')->where('language', $locale),
      ])
      ->whereHas('translations', fn ($query) => $query->where('language', $locale))
      ->where('is_active', 1)
      ->where('product_id', $this->productId)
      ->orderBy('slug')
      ->get();

    if ($productVariants->isEmpty()) {
      abort(404);
    }

    $this->variantTabs = $productVariants->map(fn ($v) => [
      'slug' => $v->slug,
      'name' => $v->translations->first()->name,
    ])->all();

    $selectedVariant = $productVariant
      ? $productVariants->where('slug', $productVariant)->first() ?? abort(404)
      : $productVariants->first();

    $this->selectedVariantId = $selectedVariant->id;
    $this->productVariantSlug = $selectedVariant->slug;
  }

  #[Computed]
  public function product(): Product
  {
    $locale = app()->getLocale();

    return Product::select('id', 'slug', 'cover_photo_filename', 'cover_video_filename')
      ->with([
        'translations' => fn ($query) => $query->select('name', 'product_id')->where('language', $locale),
      ])
      ->findOrFail($this->productId);
  }

  #[Computed]
  public function selectedVariant(): ProductVariant
  {
    $locale = app()->getLocale();

    return ProductVariant::select('id', 'product_id', 'slug', 'price_basic', 'price_middle', 'price_full', 'living_area', 'building_area')
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
      ->findOrFail($this->selectedVariantId);
  }

  public function render(): View
  {
    $productName = $this->product->translations[0]->name;

    return view('livewire.show-product')
      ->layout('components.layouts.app', [
        'header' => $productName,
        'title' => $productName,
      ]);
  }

  public function switchProductVariant(string $productVariantSlug): void
  {
    if ($this->productId === null) {
      return;
    }

    $variant = ProductVariant::select('id', 'slug')
      ->where('slug', $productVariantSlug)
      ->where('product_id', $this->productId)
      ->where('is_active', 1)
      ->firstOrFail();

    $this->selectedVariantId = $variant->id;
    $this->productVariantSlug = $variant->slug;

    unset($this->selectedVariant);

    $this->dispatch('update-url', url: '/' . app()->getLocale() . '/' . $this->product->slug . '/' . $this->productVariantSlug);
    $this->dispatch('variantChanged', $productVariantSlug);
  }
}
