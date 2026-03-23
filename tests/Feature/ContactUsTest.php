<?php

use App\Mail\ContactUsSubmitted;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    app()->setLocale('lv');

    $this->validPayload = [
        'first-name'                          => 'Jānis',
        'last-name'                           => 'Bērziņš',
        'email'                               => 'janis@example.com',
        'phone-number'                        => '+37120000000',
        'company'                             => 'SIA Tests',
        'customers-question'                  => 'Vai ir pieejams?',
        'subject'                             => 'Kontaktforma',
        'customer-agrees-for-data-processing' => '1',
    ];
});

describe('Contact us form submission', function () {
    it('sends email on valid submission', function () {
        Mail::fake();

        $this->post('/lv/contact-us', $this->validPayload)
            ->assertRedirect()
            ->assertSessionHas('success');

        Mail::assertSent(ContactUsSubmitted::class, function ($mail) {
            return $mail->hasTo('info@modern-house.lv')
                && $mail->data['subject'] === 'Kontaktforma';
        });
    });

    it('redirects back with success message', function () {
        Mail::fake();

        $this->from('/lv/contact-us')
            ->post('/lv/contact-us', $this->validPayload)
            ->assertRedirect()
            ->assertSessionHas('success');
    });

    it('returns error when mail fails', function () {
        Mail::fake();
        Mail::shouldReceive('to')->andThrow(new \Exception('Mail error'));

        $this->post('/lv/contact-us', $this->validPayload)
            ->assertRedirect()
            ->assertSessionHas('error');
    });
});

describe('Contact us validation', function () {
    it('requires first-name, last-name, email, phone-number', function () {
        $this->post('/lv/contact-us', [
            'customer-agrees-for-data-processing' => '1',
        ])->assertSessionHasErrors(['first-name', 'last-name', 'email', 'phone-number']);
    });

    it('requires data processing consent', function () {
        $payload = $this->validPayload;
        unset($payload['customer-agrees-for-data-processing']);

        $this->post('/lv/contact-us', $payload)
            ->assertSessionHasErrors(['customer-agrees-for-data-processing']);
    });

    it('rejects invalid email', function () {
        $payload = $this->validPayload;
        $payload['email'] = 'not-an-email';

        $this->post('/lv/contact-us', $payload)
            ->assertSessionHasErrors(['email']);
    });

    it('does not require company field', function () {
        Mail::fake();

        $payload = $this->validPayload;
        unset($payload['company']);

        $this->post('/lv/contact-us', $payload)
            ->assertSessionHas('success');
    });
});

describe('ContactUsSubmitted mailable', function () {
    it('uses subject from form data', function () {
        $mailable = new ContactUsSubmitted([
            'subject'      => 'Kontaktforma',
            'first-name'   => 'Jānis',
            'last-name'    => 'Bērziņš',
            'email'        => 'janis@example.com',
            'phone-number' => '+37120000000',
        ]);

        $mailable->assertHasSubject('Kontaktforma');
    });
});
