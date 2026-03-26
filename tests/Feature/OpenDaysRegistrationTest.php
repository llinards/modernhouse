<?php

use App\Jobs\SyncProfileToKlaviyo;
use App\Livewire\OpenDaysRegistrationForm;
use App\Mail\CustomerRegisteredForOpenDays;
use App\Models\OpenDaysRegistration;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;

beforeEach(function () {
    app()->setLocale('lv');
    config()->set('honeypot.enabled', false);

    $this->validData = [
        'date'                         => '18.jūlijs',
        'time'                         => '10:00',
        'firstName'                    => 'Jānis',
        'lastName'                     => 'Bērziņš',
        'phoneNumber'                  => '+37120000000',
        'email'                        => 'janis@example.com',
        'reason'                       => 'Interesē privātmājas iegāde',
        'consentToProcessPersonalData' => true,
    ];
});

describe('Open days registration form submission', function () {
    it('creates database record and sends email', function () {
        Mail::fake();
        Queue::fake();

        Livewire::test(OpenDaysRegistrationForm::class)
            ->set('registrationClosed', false)
            ->set('date', $this->validData['date'])
            ->set('time', $this->validData['time'])
            ->set('firstName', $this->validData['firstName'])
            ->set('lastName', $this->validData['lastName'])
            ->set('phoneNumber', $this->validData['phoneNumber'])
            ->set('email', $this->validData['email'])
            ->set('reason', $this->validData['reason'])
            ->set('consentToProcessPersonalData', true)
            ->call('register');

        expect(OpenDaysRegistration::count())->toBe(1);

        $registration = OpenDaysRegistration::first();
        expect($registration->firstName)->toBe('Jānis');
        expect($registration->email)->toBe('janis@example.com');

        Mail::assertSent(CustomerRegisteredForOpenDays::class, function ($mail) {
            return $mail->hasTo('info@modern-house.lv');
        });
    });

    it('shows success view after registration', function () {
        Mail::fake();
        Queue::fake();

        Livewire::test(OpenDaysRegistrationForm::class)
            ->set('registrationClosed', false)
            ->set('date', '19.jūlijs')
            ->set('time', '14:00')
            ->set('firstName', 'Anna')
            ->set('lastName', 'Kalniņa')
            ->set('phoneNumber', '+37120000001')
            ->set('email', 'anna@example.com')
            ->set('reason', 'Interesē privātmājas iegāde')
            ->set('consentToProcessPersonalData', true)
            ->call('register')
            ->assertSet('successView', true)
            ->assertSet('registerView', false);
    });
});

describe('Open days registration validation', function () {
    it('requires all fields', function () {
        Livewire::test(OpenDaysRegistrationForm::class)
            ->set('registrationClosed', false)
            ->call('register')
            ->assertHasErrors(['date', 'time', 'firstName', 'lastName', 'phoneNumber', 'email', 'reason', 'consentToProcessPersonalData']);
    });

    it('rejects invalid date', function () {
        Livewire::test(OpenDaysRegistrationForm::class)
            ->set('registrationClosed', false)
            ->set('date', '20.jūlijs')
            ->call('register')
            ->assertHasErrors(['date']);
    });

    it('rejects invalid time', function () {
        Livewire::test(OpenDaysRegistrationForm::class)
            ->set('registrationClosed', false)
            ->set('time', '09:30')
            ->call('register')
            ->assertHasErrors(['time']);
    });

    it('rejects invalid email', function () {
        Livewire::test(OpenDaysRegistrationForm::class)
            ->set('registrationClosed', false)
            ->set('email', 'not-an-email')
            ->call('register')
            ->assertHasErrors(['email']);
    });

    it('requires data processing consent', function () {
        Livewire::test(OpenDaysRegistrationForm::class)
            ->set('registrationClosed', false)
            ->set('date', $this->validData['date'])
            ->set('time', $this->validData['time'])
            ->set('firstName', $this->validData['firstName'])
            ->set('lastName', $this->validData['lastName'])
            ->set('phoneNumber', $this->validData['phoneNumber'])
            ->set('email', $this->validData['email'])
            ->set('reason', $this->validData['reason'])
            ->set('consentToProcessPersonalData', false)
            ->call('register')
            ->assertHasErrors(['consentToProcessPersonalData']);
    });
});
