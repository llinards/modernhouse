<?php

use App\Http\Services\KlaviyoService;
use App\Models\Product;
use App\Models\TranslationsProduct;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    app()->setLocale('lv');

    $product = Product::factory()->create(['slug' => 'test-product']);

    TranslationsProduct::factory()->create([
        'product_id' => $product->id,
        'name'       => 'Testa produkts',
        'language'   => 'lv',
    ]);

    $this->validPayload = [
        'product-variant'                     => 'Testa produkts',
        'first-name'                          => 'Jānis',
        'last-name'                           => 'Bērziņš',
        'email'                               => 'janis@example.com',
        'phone-number'                        => '+37120000000',
        'customer-agrees-for-data-processing' => '1',
    ];
});

describe('Request consultation form submission', function () {
    it('calls Klaviyo on valid submission', function () {
        $this->mock(KlaviyoService::class)
            ->shouldReceive('storeProfile')
            ->once();

        $this->post('/lv/request-consultation', $this->validPayload)
            ->assertRedirect()
            ->assertSessionHas('success');
    });

    it('redirects back with success message', function () {
        $this->mock(KlaviyoService::class)
            ->shouldReceive('storeProfile')
            ->once();

        $this->from('/lv/request-consultation')
            ->post('/lv/request-consultation', $this->validPayload)
            ->assertRedirect()
            ->assertSessionHas('success');
    });

    it('does not send any email', function () {
        Mail::fake();
        $this->mock(KlaviyoService::class)
            ->shouldReceive('storeProfile')
            ->once();

        $this->post('/lv/request-consultation', $this->validPayload)
            ->assertSessionHas('success');

        Mail::assertNothingSent();
    });

    it('returns error when Klaviyo service throws exception', function () {
        $this->mock(KlaviyoService::class)
            ->shouldReceive('storeProfile')
            ->andThrow(new \Exception('Klaviyo error'));

        $this->post('/lv/request-consultation', $this->validPayload)
            ->assertRedirect()
            ->assertSessionHas('error');
    });
});

describe('Request consultation validation', function () {
    it('requires first-name, last-name, email, phone-number', function () {
        $this->post('/lv/request-consultation', [
            'customer-agrees-for-data-processing' => '1',
        ])->assertSessionHasErrors(['first-name', 'last-name', 'email', 'phone-number']);
    });

    it('requires data processing consent', function () {
        $payload = $this->validPayload;
        unset($payload['customer-agrees-for-data-processing']);

        $this->post('/lv/request-consultation', $payload)
            ->assertSessionHasErrors(['customer-agrees-for-data-processing']);
    });

    it('rejects invalid email', function () {
        $payload = $this->validPayload;
        $payload['email'] = 'not-an-email';

        $this->post('/lv/request-consultation', $payload)
            ->assertSessionHasErrors(['email']);
    });
});
