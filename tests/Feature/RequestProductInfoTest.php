<?php

use App\Http\Services\KlaviyoService;
use App\Mail\RequestedProductInfo;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\TranslationsProduct;
use App\Models\TranslationsProductVariants;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    app()->setLocale('lv');

    $this->product = Product::factory()->create(['slug' => 'test-product']);

    TranslationsProduct::factory()->create([
        'product_id' => $this->product->id,
        'name' => 'Testa produkts',
        'language' => 'lv',
    ]);

    $variant = ProductVariant::factory()->create([
        'product_id' => $this->product->id,
        'slug' => 'test-variant',
    ]);

    TranslationsProductVariants::factory()->create([
        'product_variant_id' => $variant->id,
        'name' => 'Testa variants',
        'description' => '<p>Apraksts</p>',
        'language' => 'lv',
    ]);

    $this->validPayload = [
        'product-name' => 'Testa produkts',
        'product-variant' => 'Testa variants',
        'product-variant-option' => 'Basic',
        'first-name' => 'Jānis',
        'last-name' => 'Bērziņš',
        'email' => 'janis@example.com',
        'phone-number' => '+37120000000',
        'company' => 'SIA Tests',
        'customers-question' => 'Vai ir pieejams?',
        'customer-agrees-for-data-processing' => '1',
    ];
});

describe('Request product info form submission', function () {
    it('sends email and calls Klaviyo on valid submission', function () {
        Mail::fake();
        $this->mock(KlaviyoService::class)
            ->shouldReceive('storeProfile')
            ->once();

        $this->post('/lv/test-product', $this->validPayload)
            ->assertRedirect()
            ->assertSessionHas('success');

        Mail::assertSent(RequestedProductInfo::class, function ($mail) {
            return $mail->hasTo('info@modern-house.lv')
                && $mail->data['product-name'] === 'Testa produkts';
        });
    });

    it('redirects back with success message', function () {
        Mail::fake();
        $this->mock(KlaviyoService::class)
            ->shouldReceive('storeProfile')
            ->once();

        $this->from('/lv/test-product')
            ->post('/lv/test-product', $this->validPayload)
            ->assertRedirect()
            ->assertSessionHas('success');
    });

    it('returns error when Klaviyo service throws exception', function () {
        Mail::fake();
        $this->mock(KlaviyoService::class)
            ->shouldReceive('storeProfile')
            ->andThrow(new \Exception('Klaviyo error'));

        $this->post('/lv/test-product', $this->validPayload)
            ->assertRedirect()
            ->assertSessionHas('error');

        Mail::assertNothingSent();
    });
});

describe('Request product info validation', function () {
    it('requires first-name, last-name, email, phone-number', function () {
        $this->post('/lv/test-product', [
            'customer-agrees-for-data-processing' => '1',
        ])->assertSessionHasErrors(['first-name', 'last-name', 'email', 'phone-number']);
    });

    it('requires data processing consent', function () {
        $payload = $this->validPayload;
        unset($payload['customer-agrees-for-data-processing']);

        $this->post('/lv/test-product', $payload)
            ->assertSessionHasErrors(['customer-agrees-for-data-processing']);
    });

    it('rejects invalid email', function () {
        $payload = $this->validPayload;
        $payload['email'] = 'not-an-email';

        $this->post('/lv/test-product', $payload)
            ->assertSessionHasErrors(['email']);
    });

    it('does not require company field', function () {
        Mail::fake();
        $this->mock(KlaviyoService::class)
            ->shouldReceive('storeProfile')
            ->once();

        $payload = $this->validPayload;
        unset($payload['company']);

        $this->post('/lv/test-product', $payload)
            ->assertSessionHas('success');
    });
});

describe('RequestedProductInfo mailable', function () {
    it('contains product name in subject', function () {
        $mailable = new RequestedProductInfo([
            'product-name' => 'Moduļu māja',
            'product-variant-option' => 'Basic',
            'first-name' => 'Jānis',
            'last-name' => 'Bērziņš',
            'email' => 'janis@example.com',
            'phone-number' => '+37120000000',
        ]);

        $mailable->assertHasSubject('Jauna ziņa no klienta par - Moduļu māja');
    });
});
