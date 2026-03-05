<?php

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantImage;
use App\Models\TranslationsProduct;
use App\Models\TranslationsProductVariants;

beforeEach(function () {
    $this->product = Product::factory()->create(['slug' => 'test-product']);

    TranslationsProduct::factory()->create([
        'product_id' => $this->product->id,
        'name' => 'Testa produkts',
        'language' => 'lv',
    ]);

    $this->variant = ProductVariant::factory()->create([
        'product_id' => $this->product->id,
        'slug' => 'test-variant',
    ]);

    TranslationsProductVariants::factory()->create([
        'product_variant_id' => $this->variant->id,
        'name' => 'Testa variants',
        'description' => '<p>Apraksts</p>',
        'language' => 'lv',
    ]);

    ProductVariantImage::factory()->create([
        'product_variant_id' => $this->variant->id,
    ]);
});

describe('Home page', function () {
    it('displays active products on homepage', function () {
        $this->get('/lv/')
            ->assertSuccessful()
            ->assertSee('Testa produkts');
    });

    it('does not display inactive products on homepage', function () {
        $this->product->update(['is_active' => false]);

        $this->get('/lv/')
            ->assertSuccessful()
            ->assertDontSee('Testa produkts');
    });

    it('redirects root to default locale', function () {
        $this->get('/')
            ->assertRedirect('/lv/');
    });
});

describe('Product page', function () {
    it('displays the product page with default variant', function () {
        $this->get('/lv/test-product')
            ->assertSuccessful()
            ->assertSee('Testa produkts');
    });

    it('displays the product page with specific variant', function () {
        $this->get('/lv/test-product/test-variant')
            ->assertSuccessful()
            ->assertSee('Testa produkts');
    });

    it('returns 404 for inactive product', function () {
        $this->product->update(['is_active' => false]);

        $this->get('/lv/test-product')
            ->assertNotFound();
    });

    it('returns 404 for product with no active variants', function () {
        $this->variant->update(['is_active' => false]);

        $this->get('/lv/test-product')
            ->assertNotFound();
    });

    it('returns 404 for non-existent product', function () {
        $this->get('/lv/non-existent-product')
            ->assertNotFound();
    });

    it('returns 404 for non-existent variant slug', function () {
        $this->get('/lv/test-product/non-existent-variant')
            ->assertNotFound();
    });
});

describe('Language switching', function () {
    it('serves product page in Latvian', function () {
        $this->get('/lv/test-product')
            ->assertSuccessful();
    });

    it('serves product page in English when translations exist', function () {
        TranslationsProduct::factory()->create([
            'product_id' => $this->product->id,
            'name' => 'Test product EN',
            'language' => 'en',
        ]);

        TranslationsProductVariants::factory()->create([
            'product_variant_id' => $this->variant->id,
            'name' => 'Test variant EN',
            'description' => '<p>Description</p>',
            'language' => 'en',
        ]);

        $this->get('/en/test-product')
            ->assertSuccessful()
            ->assertSee('Test product EN');
    });
});
