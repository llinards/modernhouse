<?php

use App\Jobs\SyncProfileToKlaviyo;
use App\Models\Product;
use App\Models\TranslationsProduct;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

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
    it('dispatches Klaviyo job on valid submission', function () {
        Queue::fake();

        $this->post('/lv/request-consultation', $this->validPayload)
            ->assertRedirect()
            ->assertSessionHas('success');

        Queue::assertPushed(SyncProfileToKlaviyo::class, function ($job) {
            return $job->profileData['email'] === 'janis@example.com'
                && $job->listId === config('klaviyo.list_id_request_consultation');
        });
    });

    it('redirects back with success message', function () {
        Queue::fake();

        $this->from('/lv/request-consultation')
            ->post('/lv/request-consultation', $this->validPayload)
            ->assertRedirect()
            ->assertSessionHas('success');
    });

    it('does not send any email', function () {
        Mail::fake();
        Queue::fake();

        $this->post('/lv/request-consultation', $this->validPayload)
            ->assertSessionHas('success');

        Mail::assertNothingSent();
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
