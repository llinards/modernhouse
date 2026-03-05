<?php

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantAttachment;
use App\Models\ProductVariantImage;
use App\Models\ProductVariantPlan;
use App\Models\TranslationsProduct;
use App\Models\TranslationsProductVariants;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->user = User::factory()->create();
    Storage::fake('public');
});

describe('Admin authentication', function () {
    it('redirects guests from admin to login', function () {
        $this->get('/admin/lv')
            ->assertRedirect('/login');
    });

    it('allows authenticated users to access admin', function () {
        $this->actingAs($this->user)
            ->get('/admin/lv')
            ->assertSuccessful();
    });
});

describe('Admin product list', function () {
    it('displays products in admin panel', function () {
        $product = Product::factory()->create();
        TranslationsProduct::factory()->create([
            'product_id' => $product->id,
            'name' => 'Admin produkts',
            'language' => 'lv',
        ]);

        $this->actingAs($this->user)
            ->get('/admin/lv')
            ->assertSuccessful()
            ->assertSee('Admin produkts');
    });
});

describe('Admin create product', function () {
    it('displays create product form', function () {
        $this->actingAs($this->user)
            ->get('/admin/lv/create')
            ->assertSuccessful();
    });

    it('creates product with slugified slug and is_active false', function () {
        $coverPhoto = UploadedFile::fake()->image('cover.jpg', 1200, 800);
        $storedPath = $coverPhoto->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv', [
                'product-name' => 'Jauns Produkts',
                'product-slug' => 'Jauns Produkts',
                'product-cover-photo' => [$storedPath],
            ])
            ->assertRedirect('/admin/lv');

        $product = Product::where('slug', 'jauns-produkts')->first();

        expect($product)->not->toBeNull()
            ->and($product->slug)->toBe('jauns-produkts')
            ->and((bool) $product->is_active)->toBeFalse()
            ->and($product->cover_photo_filename)->toBe(basename($storedPath));
    });

    it('creates translation in current locale', function () {
        $storedPath = UploadedFile::fake()->image('cover.jpg')->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv', [
                'product-name' => 'Latvian Name',
                'product-slug' => 'latvian-product',
                'product-cover-photo' => [$storedPath],
            ]);

        $product = Product::where('slug', 'latvian-product')->first();
        $translation = $product->translations()->where('language', 'lv')->first();

        expect($translation)->not->toBeNull()
            ->and($translation->name)->toBe('Latvian Name');
    });

    it('moves cover photo from temp to product directory', function () {
        $coverPhoto = UploadedFile::fake()->image('cover.jpg', 1200, 800);
        $storedPath = $coverPhoto->store('uploads/temp', 'public');
        $filename = basename($storedPath);

        $this->actingAs($this->user)
            ->post('/admin/lv', [
                'product-name' => 'Media Test',
                'product-slug' => 'media-test',
                'product-cover-photo' => [$storedPath],
            ]);

        Storage::disk('public')->assertExists("product-images/media-test/{$filename}");
        Storage::disk('public')->assertMissing($storedPath);
    });

    it('creates product with cover video when provided', function () {
        $coverPath = UploadedFile::fake()->image('cover.jpg')->store('uploads/temp', 'public');
        $videoPath = UploadedFile::fake()->create('video.mp4', 1000)->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv', [
                'product-name' => 'Video Product',
                'product-slug' => 'video-product',
                'product-cover-photo' => [$coverPath],
                'product-cover-video' => [$videoPath],
            ]);

        $product = Product::where('slug', 'video-product')->first();

        expect($product->cover_video_filename)->toBe(basename($videoPath));
    });

    it('validates required fields when creating product', function () {
        $this->actingAs($this->user)
            ->post('/admin/lv', [])
            ->assertSessionHasErrors(['product-name', 'product-slug', 'product-cover-photo']);
    });

    it('returns error for duplicate slug', function () {
        Product::factory()->create(['slug' => 'existing-slug']);

        $storedPath = UploadedFile::fake()->image('cover.jpg')->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv', [
                'product-name' => 'Duplicate',
                'product-slug' => 'existing-slug',
                'product-cover-photo' => [$storedPath],
            ])
            ->assertRedirect()
            ->assertSessionHas('error');
    });
});

describe('Admin update product', function () {
    beforeEach(function () {
        $this->product = Product::factory()->create([
            'slug' => 'original-slug',
            'cover_photo_filename' => 'old-cover.jpg',
            'is_active' => false,
        ]);
        TranslationsProduct::factory()->create([
            'product_id' => $this->product->id,
            'name' => 'Original Name',
            'language' => 'lv',
        ]);
    });

    it('displays edit product form', function () {
        $this->actingAs($this->user)
            ->get("/admin/lv/{$this->product->slug}/edit")
            ->assertSuccessful();
    });

    it('updates product name translation', function () {
        $this->actingAs($this->user)
            ->patch('/admin/lv', [
                'id' => $this->product->id,
                'product-name' => 'Updated Name',
                'product-slug' => 'original-slug',
            ])
            ->assertRedirect('/admin/lv');

        $translation = $this->product->fresh()->translations()->where('language', 'lv')->first();

        expect($translation->name)->toBe('Updated Name');
    });

    it('updates slug and renames directory', function () {
        Storage::disk('public')->makeDirectory("product-images/original-slug");
        Storage::disk('public')->put("product-images/original-slug/old-cover.jpg", 'fake');

        $this->actingAs($this->user)
            ->patch('/admin/lv', [
                'id' => $this->product->id,
                'product-name' => 'Updated Name',
                'product-slug' => 'New Slug',
            ])
            ->assertRedirect('/admin/lv');

        $product = $this->product->fresh();

        expect($product->slug)->toBe('new-slug');
        Storage::disk('public')->assertExists("product-images/new-slug");
    });

    it('activates product when product-available is set', function () {
        $this->actingAs($this->user)
            ->patch('/admin/lv', [
                'id' => $this->product->id,
                'product-name' => 'Active Product',
                'product-slug' => 'original-slug',
                'product-available' => 'on',
            ]);

        expect($this->product->fresh()->is_active)->toBeTruthy();
    });

    it('deactivates product when product-available is missing', function () {
        $this->product->update(['is_active' => true]);

        $this->actingAs($this->user)
            ->patch('/admin/lv', [
                'id' => $this->product->id,
                'product-name' => 'Inactive Product',
                'product-slug' => 'original-slug',
            ]);

        expect($this->product->fresh()->is_active)->toBeFalsy();
    });

    it('updates cover photo when new one is provided', function () {
        $newCover = UploadedFile::fake()->image('new-cover.jpg')->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->patch('/admin/lv', [
                'id' => $this->product->id,
                'product-name' => 'Cover Update',
                'product-slug' => 'original-slug',
                'product-cover-photo' => [$newCover],
            ]);

        expect($this->product->fresh()->cover_photo_filename)->toBe(basename($newCover));
    });

    it('keeps existing cover photo when none is provided', function () {
        $this->actingAs($this->user)
            ->patch('/admin/lv', [
                'id' => $this->product->id,
                'product-name' => 'No Cover Change',
                'product-slug' => 'original-slug',
            ]);

        expect($this->product->fresh()->cover_photo_filename)->toBe('old-cover.jpg');
    });

    it('creates translation if one does not exist for locale', function () {
        app()->setLocale('en');

        $this->actingAs($this->user)
            ->patch('/admin/en', [
                'id' => $this->product->id,
                'product-name' => 'English Name',
            ]);

        $enTranslation = $this->product->translations()->where('language', 'en')->first();

        expect($enTranslation)->not->toBeNull()
            ->and($enTranslation->name)->toBe('English Name');
    });

    it('validates required fields when updating product', function () {
        $this->actingAs($this->user)
            ->patch('/admin/lv', [])
            ->assertSessionHasErrors(['product-name']);
    });
});

describe('Admin delete product', function () {
    it('deletes product and its storage directory', function () {
        $product = Product::factory()->create(['slug' => 'delete-test']);
        Storage::disk('public')->makeDirectory("product-images/delete-test");
        Storage::disk('public')->put("product-images/delete-test/cover.jpg", 'fake');

        $this->actingAs($this->user)
            ->delete("/admin/lv/{$product->slug}/delete")
            ->assertRedirect('/admin/lv');

        expect(Product::where('slug', 'delete-test')->exists())->toBeFalse();
        Storage::disk('public')->assertMissing("product-images/delete-test");
    });

    it('deletes product video and nulls the column', function () {
        $product = Product::factory()->create([
            'slug' => 'video-delete',
            'cover_video_filename' => 'intro.mp4',
        ]);
        Storage::disk('public')->put("product-images/video-delete/intro.mp4", 'fake');

        $this->actingAs($this->user)
            ->get("/admin/lv/{$product->slug}/video/delete")
            ->assertRedirect();

        $product->refresh();

        expect($product->cover_video_filename)->toBeNull();
        Storage::disk('public')->assertMissing("product-images/video-delete/intro.mp4");
    });
});

describe('Admin create product variant', function () {
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
            ->and((bool) $variant->is_active)->toBeFalse()
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

describe('Admin update product variant', function () {
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

describe('Admin delete product variant', function () {
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
