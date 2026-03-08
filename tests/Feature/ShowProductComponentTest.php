<?php

use App\Livewire\ShowProduct;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantDetail;
use App\Models\ProductVariantImage;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use App\Models\TranslationsProduct;
use App\Models\TranslationsProductVariants;
use Livewire\Livewire;

beforeEach(function () {
    $this->product = Product::factory()->create(['slug' => 'livewire-test']);

    TranslationsProduct::factory()->create([
        'product_id' => $this->product->id,
        'name' => 'Livewire produkts',
        'language' => 'lv',
    ]);

    $this->variant1 = ProductVariant::factory()->create([
        'product_id' => $this->product->id,
        'slug' => 'variant-a',
    ]);

    TranslationsProductVariants::factory()->create([
        'product_variant_id' => $this->variant1->id,
        'name' => 'Variants A',
        'description' => '<p>Apraksts A</p>',
        'language' => 'lv',
    ]);

    ProductVariantImage::factory()->count(2)->create([
        'product_variant_id' => $this->variant1->id,
    ]);

    $this->variant2 = ProductVariant::factory()->create([
        'product_id' => $this->product->id,
        'slug' => 'variant-b',
    ]);

    TranslationsProductVariants::factory()->create([
        'product_variant_id' => $this->variant2->id,
        'name' => 'Variants B',
        'description' => '<p>Apraksts B</p>',
        'language' => 'lv',
    ]);

    ProductVariantImage::factory()->create([
        'product_variant_id' => $this->variant2->id,
    ]);

    app()->setLocale('lv');
});

describe('ShowProduct component mount', function () {
    it('mounts with default first variant', function () {
        Livewire::test(ShowProduct::class, [
            'product' => $this->product,
        ])
            ->assertSet('product.slug', 'livewire-test')
            ->assertSet('productVariantSlug', 'variant-a')
            ->assertSuccessful();
    });

    it('mounts with a specific variant', function () {
        Livewire::test(ShowProduct::class, [
            'product' => $this->product,
            'productVariant' => 'variant-b',
        ])
            ->assertSet('productVariantSlug', 'variant-b')
            ->assertSuccessful();
    });
});

describe('ShowProduct variant switching', function () {
    it('switches between variants', function () {
        Livewire::test(ShowProduct::class, [
            'product' => $this->product,
        ])
            ->assertSet('productVariantSlug', 'variant-a')
            ->call('switchProductVariant', 'variant-b')
            ->assertSet('productVariantSlug', 'variant-b')
            ->assertDispatched('update-url')
            ->assertDispatched('variantChanged');
    });

    it('handles switching when productId is null', function () {
        $component = new ShowProduct();

        $component->switchProductVariant('variant-b');

        expect($component->productId)->toBeNull();
        expect($component->selectedVariantId)->toBeNull();
    });
});

describe('ShowProduct with variant details', function () {
    it('loads variant details', function () {
        ProductVariantDetail::factory()->create([
            'product_variant_id' => $this->variant1->id,
            'name' => 'Guļamistabas',
            'icon' => 'bed',
            'hasThis' => true,
            'count' => 2,
            'language' => 'lv',
        ]);

        Livewire::test(ShowProduct::class, [
            'product' => $this->product,
        ])->assertSee('Guļamistabas');
    });

    it('loads variant options with details', function () {
        $option = ProductVariantOption::factory()->create([
            'product_variant_id' => $this->variant1->id,
            'option_title' => 'Ārsienas',
            'language' => 'lv',
        ]);

        ProductVariantOptionDetail::factory()->create([
            'product_variant_option_id' => $option->id,
            'detail' => 'Koka karkass',
        ]);

        Livewire::test(ShowProduct::class, [
            'product' => $this->product,
        ])
            ->assertSee('Ārsienas')
            ->assertSee('Koka karkass');
    });
});
