<?php

namespace App\Providers;

use Whitecube\LaravelCookieConsent\Consent;
use Whitecube\LaravelCookieConsent\Cookie;
use Whitecube\LaravelCookieConsent\CookiesRegistrar;
use Whitecube\LaravelCookieConsent\CookiesServiceProvider as ServiceProvider;

class CookiesServiceProvider extends ServiceProvider
{
    /**
     * Define the cookies users should be aware of.
     */
    protected function registerCookies(): void
    {
        $registrar = app(CookiesRegistrar::class);

        $registrar->essentials()
            ->session()
            ->csrf();

        $registrar->analytics()
            ->google(
                id: config('cookieconsent.google_analytics.id'),
                anonymizeIp: config('cookieconsent.google_analytics.anonymize_ip')
            )
            ->name('ga4_events')
            ->description(__('cookieConsent::cookies.defaults.ga4_events'))
            ->duration(2 * 365 * 24 * 60)
            ->accepted(fn (Consent $consent) => $consent->script(
                '<script>function trackFormSubmit(event){gtag("event",event,{"event_category":event,"event_label":"Submit Form"});}</script>'
            ));

        $registrar->category('marketing');

        $registrar->marketing()
            ->name('_fbp')
            ->description(__('cookieConsent::cookies.defaults._fbp'))
            ->duration(180 * 24 * 60)
            ->accepted(fn (Consent $consent) => $consent->script(
                view('includes.tracking.facebook-pixel')->render()
            ));

        $registrar->marketing()
            ->name('klaviyo')
            ->description(__('cookieConsent::cookies.defaults.klaviyo'))
            ->duration(365 * 24 * 60)
            ->accepted(fn (Consent $consent) => $consent->script(
                '<script async type="text/javascript" src="https://static.klaviyo.com/onsite/js/klaviyo.js?company_id=' . config('cookieconsent.klaviyo.company_id') . '"></script>'
            ));
    }
}
