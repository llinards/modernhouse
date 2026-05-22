<?php

use App\Models\PromoModal;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->user = User::factory()->create();
    Storage::fake('public');
});

function validPromoModalPayload(array $overrides = []): array
{
    return array_merge([
        'is_enabled' => '1',
        'title' => 'Atvērto durvju dienas',
        'description' => "Nāc ciemos!\nGaidām tevi.",
        'cta_label' => 'Pieteikties',
        'cta_url' => 'https://modernhouse.test/pieteikties',
        'starts_at' => '2026-05-01',
        'ends_at' => '2026-06-01',
    ], $overrides);
}

it('displays the promo modal section on admin index', function () {
    $this->actingAs($this->user)
        ->get('/admin/lv')
        ->assertSuccessful()
        ->assertSee('Sākumlapas reklāmas logs');
});

it('redirects guests to login', function () {
    $this->post('/admin/lv/promo-modal', [])
        ->assertRedirect('/login');
});

it('saves the promo modal and stores the uploaded image', function () {
    $tempPath = UploadedFile::fake()->image('promo.jpg')->store('uploads/temp', 'public');

    $this->actingAs($this->user)
        ->post(route('admin.promo-modal.update', ['locale' => 'lv']), validPromoModalPayload([
            'promo-modal-image' => [$tempPath],
        ]))
        ->assertRedirect()
        ->assertSessionHas('success');

    $promoModal = PromoModal::first();

    expect($promoModal->is_enabled)->toBeTrue()
        ->and($promoModal->title)->toBe('Atvērto durvju dienas')
        ->and($promoModal->cta_url)->toBe('https://modernhouse.test/pieteikties')
        ->and($promoModal->image_filename)->not->toBeNull();

    Storage::disk('public')->assertExists('promo-modal/'.$promoModal->image_filename);
    Storage::disk('public')->assertMissing($tempPath);
});

it('keeps the existing image when no new one is uploaded', function () {
    $existing = PromoModal::factory()->create(['image_filename' => 'existing.jpg']);

    $this->actingAs($this->user)
        ->post(route('admin.promo-modal.update', ['locale' => 'lv']), validPromoModalPayload())
        ->assertRedirect()
        ->assertSessionHas('success');

    expect($existing->fresh()->image_filename)->toBe('existing.jpg');
});

it('keeps the existing image when filepond resubmits its stored path', function () {
    Storage::disk('public')->put('promo-modal/existing.jpg', 'image-content');
    $existing = PromoModal::factory()->create(['image_filename' => 'existing.jpg']);

    $this->actingAs($this->user)
        ->post(route('admin.promo-modal.update', ['locale' => 'lv']), validPromoModalPayload([
            'promo-modal-image' => ['promo-modal/existing.jpg'],
        ]))
        ->assertRedirect()
        ->assertSessionHas('success');

    expect($existing->fresh()->image_filename)->toBe('existing.jpg');
    Storage::disk('public')->assertExists('promo-modal/existing.jpg');
});

it('treats an unchecked enabled box as disabled', function () {
    PromoModal::factory()->create(['image_filename' => 'existing.jpg']);

    $this->actingAs($this->user)
        ->post(route('admin.promo-modal.update', ['locale' => 'lv']), validPromoModalPayload([
            'is_enabled' => null,
        ]))
        ->assertSessionHas('success');

    expect(PromoModal::first()->is_enabled)->toBeFalse();
});

it('normalizes the cta link to an https url', function (string $input, string $expected) {
    $tempPath = UploadedFile::fake()->image('promo.jpg')->store('uploads/temp', 'public');

    $this->actingAs($this->user)
        ->post(route('admin.promo-modal.update', ['locale' => 'lv']), validPromoModalPayload([
            'cta_url' => $input,
            'promo-modal-image' => [$tempPath],
        ]))
        ->assertRedirect()
        ->assertSessionHas('success');

    expect(PromoModal::first()->cta_url)->toBe($expected);
})->with([
    'already https' => ['https://example.com/page', 'https://example.com/page'],
    'http upgraded to https' => ['http://example.com/page', 'https://example.com/page'],
    'missing scheme gets https' => ['example.com/page', 'https://example.com/page'],
]);

it('validates required fields with latvian messages', function () {
    $this->actingAs($this->user)
        ->post(route('admin.promo-modal.update', ['locale' => 'lv']), [])
        ->assertSessionHasErrors([
            'title' => 'Nav norādīts virsraksts.',
            'cta_label' => 'Nav norādīts pogas teksts.',
            'cta_url' => 'Nav norādīta pogas saite.',
            'promo-modal-image' => 'Nav pievienota bilde.',
        ])
        ->assertSessionDoesntHaveErrors('description');
});

it('rejects an end date before the start date', function () {
    $tempPath = UploadedFile::fake()->image('promo.jpg')->store('uploads/temp', 'public');

    $this->actingAs($this->user)
        ->post(route('admin.promo-modal.update', ['locale' => 'lv']), validPromoModalPayload([
            'starts_at' => '2026-06-01',
            'ends_at' => '2026-05-01',
            'promo-modal-image' => [$tempPath],
        ]))
        ->assertSessionHasErrors(['ends_at' => 'Beigu datumam jābūt vienādam vai vēlākam par sākuma datumu.']);
});

it('shows the modal on the lv homepage when active', function () {
    PromoModal::factory()->create([
        'title' => 'Reklāmas virsraksts',
        'description' => '<p>Apraksts ar <strong>treknrakstu</strong>.</p>',
    ]);

    $this->get('/lv')
        ->assertSuccessful()
        ->assertSee('id="promo-modal"', false)
        ->assertSee('Reklāmas virsraksts')
        ->assertSee('<strong>treknrakstu</strong>', false);
});

it('hides the modal on the lv homepage when disabled', function () {
    PromoModal::factory()->disabled()->create();

    $this->get('/lv')
        ->assertSuccessful()
        ->assertDontSee('id="promo-modal"', false);
});

it('hides the modal on non-lv homepages', function () {
    PromoModal::factory()->create();

    $this->get('/en')
        ->assertSuccessful()
        ->assertDontSee('id="promo-modal"', false);
});

it('determines display correctly', function (array $attributes, bool $expected) {
    $promoModal = PromoModal::factory()->make($attributes);

    expect($promoModal->shouldDisplay())->toBe($expected);
})->with([
    'enabled with complete content' => [[], true],
    'disabled' => [['is_enabled' => false], false],
    'missing image' => [['image_filename' => null], false],
    'missing title' => [['title' => null], false],
    'missing cta label' => [['cta_label' => null], false],
    'within date window' => [['starts_at' => now()->subDay(), 'ends_at' => now()->addDay()], true],
    'starts in the future' => [['starts_at' => now()->addDay()], false],
    'ended in the past' => [['ends_at' => now()->subDay()], false],
    'ends today is still active' => [['ends_at' => now()], true],
]);
