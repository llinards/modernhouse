<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->user = User::factory()->create();
    Storage::fake('public');
});

describe('Store temporary upload', function () {
    it('requires authentication', function () {
        $this->post('/admin/lv/upload')
            ->assertRedirect();
    });

    it('stores a product cover photo with standardized filename', function () {
        $file = UploadedFile::fake()->image('original-name.jpg');

        $response = $this->actingAs($this->user)
            ->post('/admin/lv/upload', ['product-cover-photo' => [$file]]);

        $response->assertSuccessful();
        Storage::disk('public')->assertExists('uploads/temp/cover.jpg');
    });

    it('stores a product variant plan with random filename', function () {
        $file = UploadedFile::fake()->create('plan.pdf', 100);

        $response = $this->actingAs($this->user)
            ->post('/admin/lv/upload', ['product-variant-plan' => [$file]]);

        $response->assertSuccessful();

        $files = Storage::disk('public')->files('uploads/temp');
        expect($files)->toHaveCount(1)
            ->and($files[0])->toEndWith('.pdf')
            ->and($files[0])->not->toContain('plan.pdf');
    });

    it('stores other file types with original filename', function () {
        $file = UploadedFile::fake()->image('my-gallery-photo.jpg');

        $response = $this->actingAs($this->user)
            ->post('/admin/lv/upload', ['gallery-images' => [$file]]);

        $response->assertSuccessful();
        Storage::disk('public')->assertExists('uploads/temp/my-gallery-photo.jpg');
    });

    it('returns the storage path', function () {
        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->actingAs($this->user)
            ->post('/admin/lv/upload', ['gallery-images' => [$file]]);

        expect($response->getContent())->toBe('uploads/temp/photo.jpg');
    });

    it('returns empty string when no file is uploaded', function () {
        $response = $this->actingAs($this->user)
            ->post('/admin/lv/upload');

        expect($response->getContent())->toBe('');
    });
});

describe('Destroy temporary upload', function () {
    it('requires authentication', function () {
        $this->delete('/admin/lv/upload')
            ->assertRedirect();
    });

    it('deletes the specified file', function () {
        Storage::disk('public')->put('uploads/temp/test-file.jpg', 'content');

        $this->actingAs($this->user)
            ->call('DELETE', '/admin/lv/upload', [], [], [], [], 'uploads/temp/test-file.jpg')
            ->assertSuccessful();

        Storage::disk('public')->assertMissing('uploads/temp/test-file.jpg');
    });

    it('rejects path traversal attempts', function () {
        $this->actingAs($this->user)
            ->call('DELETE', '/admin/lv/upload', [], [], [], [], '../../.env')
            ->assertForbidden();
    });

    it('rejects paths outside uploads/temp', function () {
        $this->actingAs($this->user)
            ->call('DELETE', '/admin/lv/upload', [], [], [], [], 'product-images/some-file.jpg')
            ->assertForbidden();
    });
});

describe('Load upload', function () {
    it('requires authentication', function () {
        $this->get('/admin/lv/upload')
            ->assertRedirect();
    });

    it('returns the file when it exists', function () {
        Storage::disk('public')->put('uploads/temp/test-file.jpg', 'content');

        $this->actingAs($this->user)
            ->get('/admin/lv/upload?source=uploads/temp/test-file.jpg')
            ->assertSuccessful();
    });

    it('returns 404 when file does not exist', function () {
        $this->actingAs($this->user)
            ->get('/admin/lv/upload?source=uploads/temp/nonexistent.jpg')
            ->assertNotFound();
    });

    it('returns 404 when source parameter is missing', function () {
        $this->actingAs($this->user)
            ->get('/admin/lv/upload')
            ->assertNotFound();
    });
});
