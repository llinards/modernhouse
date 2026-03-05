<?php

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantAttachment;
use App\Models\ProductVariantDetail;
use App\Models\ProductVariantDetailIcon;
use App\Models\ProductVariantImage;
use App\Models\ProductVariantOption;
use App\Models\ProductVariantOptionDetail;
use App\Models\ProductVariantPlan;
use App\Models\TranslationsProduct;
use App\Models\TranslationsProductVariants;

describe('Product factory', function () {
    it('creates a product', function () {
        $product = Product::factory()->create();

        expect($product)
            ->toBeInstanceOf(Product::class)
            ->slug->not->toBeEmpty()
            ->is_active->toBeTrue();
    });

    it('creates an inactive product', function () {
        $product = Product::factory()->inactive()->create();

        expect($product->is_active)->toBeFalse();
    });

    it('creates a product with translations', function () {
        $product = Product::factory()->create();

        TranslationsProduct::factory()->create([
            'product_id' => $product->id,
            'language' => 'lv',
            'name' => 'Testa produkts',
        ]);

        expect($product->translations)->toHaveCount(1)
            ->and($product->translations->first()->name)->toBe('Testa produkts');
    });
});

describe('ProductVariant factory', function () {
    it('creates a variant belonging to a product', function () {
        $product = Product::factory()->create();
        $variant = ProductVariant::factory()->create(['product_id' => $product->id]);

        expect($variant->product->id)->toBe($product->id);
    });

    it('creates a variant without prices', function () {
        $variant = ProductVariant::factory()->withoutPrices()->create();

        expect((int) $variant->price_basic)->toBe(0)
            ->and((int) $variant->price_middle)->toBe(0)
            ->and((int) $variant->price_full)->toBe(0);
    });

    it('creates variant translations', function () {
        $variant = ProductVariant::factory()->create();

        TranslationsProductVariants::factory()->create([
            'product_variant_id' => $variant->id,
            'language' => 'lv',
        ]);

        expect($variant->translations)->toHaveCount(1);
    });
});

describe('ProductVariant child factories', function () {
    it('creates variant images', function () {
        $variant = ProductVariant::factory()->create();
        ProductVariantImage::factory()->count(3)->create(['product_variant_id' => $variant->id]);

        expect($variant->productVariantImages)->toHaveCount(3);
    });

    it('creates variant details', function () {
        $variant = ProductVariant::factory()->create();
        ProductVariantDetail::factory()->create(['product_variant_id' => $variant->id]);

        expect($variant->productVariantDetails)->toHaveCount(1);
    });

    it('creates variant options with details', function () {
        $option = ProductVariantOption::factory()->create();
        ProductVariantOptionDetail::factory()->count(3)->create([
            'product_variant_option_id' => $option->id,
        ]);

        expect($option->productVariantOptionDetails)->toHaveCount(3);
    });

    it('creates variant plans', function () {
        $variant = ProductVariant::factory()->create();
        ProductVariantPlan::factory()->create(['product_variant_id' => $variant->id]);

        expect($variant->productVariantPlan)->toHaveCount(1);
    });

    it('creates variant attachments', function () {
        $variant = ProductVariant::factory()->create();
        ProductVariantAttachment::factory()->create(['product_variant_id' => $variant->id]);

        expect($variant->productVariantAttachments)->toHaveCount(1);
    });

    it('creates detail icons', function () {
        $icon = ProductVariantDetailIcon::factory()->create();

        expect($icon->name)->toEndWith('.svg');
    });
});

describe('Product relationships cascade', function () {
    it('deletes variants when product is deleted', function () {
        $product = Product::factory()->create();
        ProductVariant::factory()->count(2)->create(['product_id' => $product->id]);

        expect(ProductVariant::where('product_id', $product->id)->count())->toBe(2);

        $product->delete();

        expect(ProductVariant::where('product_id', $product->id)->count())->toBe(0);
    });

    it('deletes variant children when variant is deleted', function () {
        $variant = ProductVariant::factory()->create();
        ProductVariantImage::factory()->count(2)->create(['product_variant_id' => $variant->id]);
        ProductVariantDetail::factory()->create(['product_variant_id' => $variant->id]);
        $option = ProductVariantOption::factory()->create(['product_variant_id' => $variant->id]);
        ProductVariantOptionDetail::factory()->create(['product_variant_option_id' => $option->id]);

        $variant->delete();

        expect(ProductVariantImage::where('product_variant_id', $variant->id)->count())->toBe(0)
            ->and(ProductVariantDetail::where('product_variant_id', $variant->id)->count())->toBe(0)
            ->and(ProductVariantOption::where('product_variant_id', $variant->id)->count())->toBe(0);
    });
});
