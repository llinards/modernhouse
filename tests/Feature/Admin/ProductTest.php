<?php

use App\Models\Product;
use App\Models\TranslationsProduct;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->user = User::factory()->create();
    Storage::fake('public');
});

describe('Create product', function () {
    it('displays create product form', function () {
        $this->actingAs($this->user)
            ->get('/admin/lv/products/create')
            ->assertSuccessful();
    });

    it('creates product with slug auto-generated from name and is_active false', function () {
        $storedPath = UploadedFile::fake()->image('cover.jpg', 1200, 800)->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv/products', [
                'product-name' => 'Jauns Produkts',
                'product-cover-photo' => [$storedPath],
            ])
            ->assertRedirect('/admin/lv');

        $product = Product::where('slug', 'jauns-produkts')->first();

        expect($product)->not->toBeNull()
            ->and($product->slug)->toBe('jauns-produkts')
            ->and((bool) $product->is_active)->toBeFalsy()
            ->and($product->cover_photo_filename)->toBe(basename($storedPath));
    });

    it('creates translation in current locale', function () {
        $storedPath = UploadedFile::fake()->image('cover.jpg')->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv/products', [
                'product-name' => 'Latvian Name',
                'product-cover-photo' => [$storedPath],
            ]);

        $product = Product::where('slug', 'latvian-name')->first();
        $translation = $product->translations()->where('language', 'lv')->first();

        expect($translation)->not->toBeNull()
            ->and($translation->name)->toBe('Latvian Name');
    });

    it('moves cover photo from temp to product directory', function () {
        $storedPath = UploadedFile::fake()->image('cover.jpg', 1200, 800)->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv/products', [
                'product-name' => 'Media Test',
                'product-cover-photo' => [$storedPath],
            ]);

        Storage::disk('public')->assertExists("product-images/media-test/" . basename($storedPath));
        Storage::disk('public')->assertMissing($storedPath);
    });

    it('creates product with cover video when provided', function () {
        $coverPath = UploadedFile::fake()->image('cover.jpg')->store('uploads/temp', 'public');
        $videoPath = UploadedFile::fake()->create('video.mp4', 1000)->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv/products', [
                'product-name' => 'Video Product',
                'product-cover-photo' => [$coverPath],
                'product-cover-video' => [$videoPath],
            ]);

        $product = Product::where('slug', 'video-product')->first();

        expect($product->cover_video_filename)->toBe(basename($videoPath));
    });

    it('validates required fields when creating product', function () {
        $this->actingAs($this->user)
            ->post('/admin/lv/products', [])
            ->assertSessionHasErrors(['product-name', 'product-cover-photo']);
    });

    it('returns validation error for duplicate slug', function () {
        Product::factory()->create(['slug' => 'existing-slug']);

        $storedPath = UploadedFile::fake()->image('cover.jpg')->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv/products', [
                'product-name' => 'existing slug',
                'product-cover-photo' => [$storedPath],
            ])
            ->assertRedirect()
            ->assertSessionHasErrors(['slug']);
    });
});

describe('Update product', function () {
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
            ->get("/admin/lv/products/{$this->product->slug}/edit")
            ->assertSuccessful();
    });

    it('updates product name translation', function () {
        $this->actingAs($this->user)
            ->patch("/admin/lv/products/{$this->product->slug}", [
                'product-name' => 'Updated Name',
            ])
            ->assertRedirect('/admin/lv');

        $translation = $this->product->fresh()->translations()->where('language', 'lv')->first();

        expect($translation->name)->toBe('Updated Name');
    });

    it('updates slug from name and renames directory in latvian locale', function () {
        Storage::disk('public')->makeDirectory("product-images/original-slug");
        Storage::disk('public')->put("product-images/original-slug/old-cover.jpg", 'fake');

        $this->actingAs($this->user)
            ->patch("/admin/lv/products/{$this->product->slug}", [
                'product-name' => 'Updated Name',
            ])
            ->assertRedirect('/admin/lv');

        expect($this->product->fresh()->slug)->toBe('updated-name');
        Storage::disk('public')->assertExists("product-images/updated-name");
    });

    it('does not change slug when editing in non-latvian locale', function () {
        app()->setLocale('en');

        $this->actingAs($this->user)
            ->patch("/admin/en/products/{$this->product->slug}", [
                'product-name' => 'English Name',
            ]);

        expect($this->product->fresh()->slug)->toBe('original-slug');
    });

    it('activates product when product-available is set', function () {
        $this->actingAs($this->user)
            ->patch("/admin/lv/products/{$this->product->slug}", [
                'product-name' => 'Active Product',
                'product-available' => 'on',
            ]);

        expect($this->product->fresh()->is_active)->toBeTruthy();
    });

    it('deactivates product when product-available is missing', function () {
        $this->product->update(['is_active' => true]);

        $this->actingAs($this->user)
            ->patch("/admin/lv/products/{$this->product->slug}", [
                'product-name' => 'Inactive Product',
            ]);

        expect($this->product->fresh()->is_active)->toBeFalsy();
    });

    it('updates cover photo when new one is provided', function () {
        $newCover = UploadedFile::fake()->image('new-cover.jpg')->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->patch("/admin/lv/products/{$this->product->slug}", [
                'product-name' => 'Cover Update',
                'product-cover-photo' => [$newCover],
            ]);

        expect($this->product->fresh()->cover_photo_filename)->toBe(basename($newCover));
    });

    it('updates cover video when new one is provided', function () {
        $newVideo = UploadedFile::fake()->create('new-video.mp4', 1000)->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->patch("/admin/lv/products/{$this->product->slug}", [
                'product-name' => 'Original Name',
                'product-cover-video' => [$newVideo],
            ]);

        expect($this->product->fresh()->cover_video_filename)->toBe(basename($newVideo));
    });

    it('keeps existing cover photo when none is provided', function () {
        $this->actingAs($this->user)
            ->patch("/admin/lv/products/{$this->product->slug}", [
                'product-name' => 'No Cover Change',
            ]);

        expect($this->product->fresh()->cover_photo_filename)->toBe('old-cover.jpg');
    });

    it('creates translation if one does not exist for locale', function () {
        app()->setLocale('en');

        $this->actingAs($this->user)
            ->patch("/admin/en/products/{$this->product->slug}", [
                'product-name' => 'English Name',
            ]);

        $enTranslation = $this->product->translations()->where('language', 'en')->first();

        expect($enTranslation)->not->toBeNull()
            ->and($enTranslation->name)->toBe('English Name');
    });

    it('validates required fields when updating product', function () {
        $this->actingAs($this->user)
            ->patch("/admin/lv/products/{$this->product->slug}", [])
            ->assertSessionHasErrors(['product-name']);
    });
});

describe('Delete product', function () {
    it('deletes product and its storage directory', function () {
        $product = Product::factory()->create(['slug' => 'delete-test']);
        Storage::disk('public')->makeDirectory("product-images/delete-test");
        Storage::disk('public')->put("product-images/delete-test/cover.jpg", 'fake');

        $this->actingAs($this->user)
            ->delete("/admin/lv/products/{$product->slug}/delete")
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
            ->delete("/admin/lv/products/{$product->slug}/video")
            ->assertRedirect();

        $product->refresh();

        expect($product->cover_video_filename)->toBeNull();
        Storage::disk('public')->assertMissing("product-images/video-delete/intro.mp4");
    });
});
