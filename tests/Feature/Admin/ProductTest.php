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
            ->get('/admin/lv/create')
            ->assertSuccessful();
    });

    it('creates product with slugified slug and is_active false', function () {
        $storedPath = UploadedFile::fake()->image('cover.jpg', 1200, 800)->store('uploads/temp', 'public');

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
            ->and((bool) $product->is_active)->toBeFalsy()
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
        $storedPath = UploadedFile::fake()->image('cover.jpg', 1200, 800)->store('uploads/temp', 'public');

        $this->actingAs($this->user)
            ->post('/admin/lv', [
                'product-name' => 'Media Test',
                'product-slug' => 'media-test',
                'product-cover-photo' => [$storedPath],
            ]);

        Storage::disk('public')->assertExists("product-images/media-test/" . basename($storedPath));
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

        expect($this->product->fresh()->slug)->toBe('new-slug');
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

describe('Delete product', function () {
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
