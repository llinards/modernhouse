<?php

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\TranslationsProductVariants;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->user = User::factory()->create();
    Storage::fake('public');
});

describe('Create product variant', function () {
    it('displays create variant form', function () {
        $this->actingAs($this->user)
            ->get('/admin/lv/product-variant/create')
            ->assertSuccessful();
    });

    it('creates variant with slugified name, is_active false, and moves images', function () {
        $product = Product::factory()->create(['slug' => 'parent-product']);
        $imagePath = UploadedFile::fake()->image('house.jpg')->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv/product-variant', [
                'product-id' => $product->id,
                'product-variant-name' => 'Modulis Test',
                'product-variant-basic-price' => 30000,
                'product-variant-middle-price' => 45000,
                'product-variant-full-price' => 60000,
                'product-variant-living-area' => 42.5,
                'product-variant-building-area' => 55.0,
                'product-variant-description' => '<p>Test description</p>',
                'product-variant-images' => [$imagePath],
            ])
            ->assertRedirect('/admin/lv');

        $variant = ProductVariant::where('slug', 'modulis-test')->first();

        expect($variant)->not->toBeNull()
            ->and((bool) $variant->is_active)->toBeFalsy()
            ->and($variant->price_basic)->toBe('30000')
            ->and($variant->product_id)->toBe($product->id);

        $translation = $variant->translations()->where('language', 'lv')->first();

        expect($translation->name)->toBe('Modulis Test')
            ->and($translation->description)->toBe('<p>Test description</p>');

        expect($variant->productVariantImages)->toHaveCount(1);
        Storage::disk('public')->assertExists(
            "product-images/parent-product/modulis-test/" . basename($imagePath)
        );
    });

    it('creates variant with plan and attachment', function () {
        $product = Product::factory()->create(['slug' => 'plan-test-product']);

        $imagePath = UploadedFile::fake()->image('img.jpg')->store('uploads/temp', 'public');
        $planPath = UploadedFile::fake()->image('plan.jpg')->store('uploads/temp', 'public');
        $attachmentPath = UploadedFile::fake()->create('specs.pdf')->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv/product-variant', [
                'product-id' => $product->id,
                'product-variant-name' => 'Full Variant',
                'product-variant-basic-price' => null,
                'product-variant-middle-price' => null,
                'product-variant-full-price' => null,
                'product-variant-living-area' => 100,
                'product-variant-building-area' => 120,
                'product-variant-description' => '<p>Full test</p>',
                'product-variant-images' => [$imagePath],
                'product-variant-plan' => [$planPath],
                'product-variant-attachments' => [$attachmentPath],
            ])
            ->assertRedirect('/admin/lv');

        $variant = ProductVariant::where('slug', 'full-variant')->first();

        expect($variant->productVariantPlan)->toHaveCount(1)
            ->and($variant->productVariantAttachments)->toHaveCount(1);

        Storage::disk('public')->assertExists(
            "product-images/plan-test-product/full-variant/plan/" . basename($planPath)
        );
    });

    it('validates required fields when creating variant', function () {
        $this->actingAs($this->user)
            ->post('/admin/lv/product-variant', [])
            ->assertSessionHasErrors([
                'product-id',
                'product-variant-name',
                'product-variant-living-area',
                'product-variant-building-area',
                'product-variant-description',
                'product-variant-images',
            ]);
    });
});

describe('Update product variant', function () {
    beforeEach(function () {
        $this->product = Product::factory()->create(['slug' => 'parent']);
        $this->variant = ProductVariant::factory()->create([
            'product_id' => $this->product->id,
            'slug' => 'original-variant',
            'price_basic' => 10000,
        ]);
        TranslationsProductVariants::factory()->create([
            'product_variant_id' => $this->variant->id,
            'name' => 'Original Variant',
            'description' => '<p>Old</p>',
            'language' => 'lv',
        ]);
    });

    it('displays edit variant form', function () {
        $this->actingAs($this->user)
            ->get("/admin/lv/product-variant/{$this->variant->id}/edit")
            ->assertSuccessful();
    });

    it('updates variant prices and areas', function () {
        $this->actingAs($this->user)
            ->patch('/admin/lv/product-variant', [
                'id' => $this->variant->id,
                'product-variant-name' => 'Original Variant',
                'product-variant-basic-price' => 50000,
                'product-variant-middle-price' => 60000,
                'product-variant-full-price' => 70000,
                'product-variant-living-area' => 85.5,
                'product-variant-building-area' => 100.0,
                'product-variant-description' => '<p>Updated</p>',
            ])
            ->assertRedirect();

        $variant = $this->variant->fresh();

        expect($variant->price_basic)->toBe('50000')
            ->and($variant->price_full)->toBe('70000')
            ->and((float) $variant->living_area)->toBe(85.5);

        $translation = $variant->translations()->where('language', 'lv')->first();

        expect($translation->description)->toBe('<p>Updated</p>');
    });

    it('renames variant directory when slug changes', function () {
        Storage::disk('public')->makeDirectory("product-images/parent/original-variant");
        Storage::disk('public')->put("product-images/parent/original-variant/img.jpg", 'fake');

        $this->actingAs($this->user)
            ->patch('/admin/lv/product-variant', [
                'id' => $this->variant->id,
                'product-variant-name' => 'Renamed Variant',
                'product-variant-basic-price' => 10000,
                'product-variant-middle-price' => null,
                'product-variant-full-price' => null,
                'product-variant-living-area' => 40,
                'product-variant-building-area' => 50,
                'product-variant-description' => '<p>Desc</p>',
            ]);

        expect($this->variant->fresh()->slug)->toBe('renamed-variant');
        Storage::disk('public')->assertExists("product-images/parent/renamed-variant");
    });

    it('toggles variant active status', function () {
        $this->actingAs($this->user)
            ->patch('/admin/lv/product-variant', [
                'id' => $this->variant->id,
                'product-variant-name' => 'Original Variant',
                'product-variant-basic-price' => 10000,
                'product-variant-middle-price' => null,
                'product-variant-full-price' => null,
                'product-variant-living-area' => 40,
                'product-variant-building-area' => 50,
                'product-variant-description' => '<p>Desc</p>',
                'product-variant-available' => 'on',
            ]);

        expect($this->variant->fresh()->is_active)->toBeTruthy();
    });

    it('adds new images during update', function () {
        $imagePath = UploadedFile::fake()->image('new.jpg')->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->patch('/admin/lv/product-variant', [
                'id' => $this->variant->id,
                'product-variant-name' => 'Original Variant',
                'product-variant-basic-price' => 10000,
                'product-variant-middle-price' => null,
                'product-variant-full-price' => null,
                'product-variant-living-area' => 40,
                'product-variant-building-area' => 50,
                'product-variant-description' => '<p>Desc</p>',
                'product-variant-images' => [$imagePath],
            ]);

        expect($this->variant->fresh()->productVariantImages)->toHaveCount(1);
        Storage::disk('public')->assertExists(
            "product-images/parent/original-variant/" . basename($imagePath)
        );
    });
});

describe('Delete product variant', function () {
    it('deletes variant and its storage directory', function () {
        $product = Product::factory()->create(['slug' => 'del-parent']);
        $variant = ProductVariant::factory()->create([
            'product_id' => $product->id,
            'slug' => 'del-variant',
        ]);

        Storage::disk('public')->makeDirectory("product-images/del-parent/del-variant");
        Storage::disk('public')->put("product-images/del-parent/del-variant/img.jpg", 'fake');

        $this->actingAs($this->user)
            ->delete("/admin/lv/product-variant/{$variant->id}/delete")
            ->assertRedirect('/admin/lv');

        expect(ProductVariant::find($variant->id))->toBeNull();
        Storage::disk('public')->assertMissing("product-images/del-parent/del-variant");
    });
});
