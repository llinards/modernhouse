<?php

use App\Http\Services\IntroductionVideoService;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->user = User::factory()->create();
    Storage::fake('public');
});

it('displays introduction video section on admin index', function () {
    $this->actingAs($this->user)
        ->get('/admin/lv')
        ->assertSuccessful()
        ->assertSee('Pirmā skata video');
});

it('redirects guests to login', function () {
    $this->patch('/admin/lv/introduction-video')
        ->assertRedirect('/login');
});

it('validates that video is required', function () {
    $this->actingAs($this->user)
        ->patch('/admin/lv/introduction-video', [])
        ->assertSessionHasErrors('introduction-video');
});

it('replaces introduction video', function () {
    $storedPath = UploadedFile::fake()->create('test-video.mp4', 1024, 'video/mp4')
        ->store('uploads/temp', 'public');

    $mock = Mockery::mock(IntroductionVideoService::class);
    $mock->shouldReceive('replaceVideo')
        ->once()
        ->with([$storedPath]);

    $this->app->instance(IntroductionVideoService::class, $mock);

    $this->actingAs($this->user)
        ->patch('/admin/lv/introduction-video', [
            'introduction-video' => [$storedPath],
        ])
        ->assertRedirect()
        ->assertSessionHas('success');
});

it('shows existing video when video exists', function () {
    Storage::disk('public')->put('introduction-video/introduction-video.mp4', 'video-content');

    $this->actingAs($this->user)
        ->get('/admin/lv')
        ->assertSuccessful()
        ->assertSee('introduction-video\/introduction-video.mp4', false);
});
