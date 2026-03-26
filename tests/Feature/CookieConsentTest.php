<?php

use Whitecube\LaravelCookieConsent\Facades\Cookies;

it('registers essential, analytics, and marketing cookie categories', function () {
    $categories = Cookies::getCategories();
    $keys = array_map(fn ($c) => $c->key(), $categories);

    expect($keys)->toContain('essentials', 'analytics', 'marketing');
});

it('shows cookie consent banner on public pages', function () {
    $this->get('/lv')
        ->assertSuccessful()
        ->assertSee('cookies-policy');
});

it('does not load GA4 script without consent', function () {
    $this->get('/lv')
        ->assertSuccessful()
        ->assertDontSee('googletagmanager.com/gtag/js');
});

it('does not load Facebook Pixel without consent', function () {
    $this->get('/lv')
        ->assertSuccessful()
        ->assertDontSee('connect.facebook.net/en_US/fbevents.js');
});

it('does not load Klaviyo without consent', function () {
    $this->get('/lv')
        ->assertSuccessful()
        ->assertDontSee('static.klaviyo.com/onsite/js/klaviyo.js');
});

it('always includes stub functions for trackFormSubmit and fbq', function () {
    $response = $this->get('/lv');

    $response->assertSuccessful()
        ->assertSee('window.trackFormSubmit', false)
        ->assertSee('window.fbq', false);
});
