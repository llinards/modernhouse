<?php

use App\Mail\ConsultationRequested;
use App\Mail\ContactUsSubmitted;
use App\Mail\CustomerRegisteredForOpenDays;
use App\Mail\RequestedProductInfo;
use Illuminate\Support\Facades\Log;

dataset('queued mailables', [
    'product info'  => [fn () => new RequestedProductInfo(['product-name' => 'Testa produkts'])],
    'contact us'    => [fn () => new ContactUsSubmitted(['subject' => 'Kontaktforma'])],
    'consultation'  => [fn () => new ConsultationRequested(['email' => 'janis@example.com'])],
    'open days'     => [fn () => new CustomerRegisteredForOpenDays(['email' => 'janis@example.com'])],
]);

it('logs an error with recipient and reason when delivery fails', function (Closure $makeMailable) {
    Log::spy();

    $mailable = $makeMailable();
    $mailable->to('info@modern-house.lv');

    $mailable->failed(new RuntimeException('SMTP connection refused'));

    Log::shouldHaveReceived('error')->withArgs(function (string $message, array $context) {
        return str_contains($message, 'email')
            && $context['recipients'] === ['info@modern-house.lv']
            && $context['exception'] === 'SMTP connection refused';
    })->once();
})->with('queued mailables');
