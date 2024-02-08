<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <meta name="author" content="{{ config('app.name') }}">
  @if(app()->getLocale() === 'en')
    <meta name="description"
          content="Energy-efficient modular houses and modular saunas. Full cycle timber frame house construction. Demo houses available for viewing and purchase or individual project development.">
    <meta property="og:description"
          content="Energy-efficient modular houses and modular saunas. Full cycle timber frame house construction. Demo houses available for viewing and purchase or individual project development."/>
  @elseif(app()->getLocale() === 'se')
    <meta name="description"
          content="Energieffektiva modulhus och modulbastur. Helcykelkonstruktion av hus med trästomme. Demonstrationshus tillgängliga för visning och köp eller individuell projektutveckling.">
    <meta property="og:description"
          content="Energieffektiva modulhus och modulbastur. Helcykelkonstruktion av hus med trästomme. Demonstrationshus tillgängliga för visning och köp eller individuell projektutveckling."/>
  @elseif(app()->getLocale() === 'no')
    <meta name="description"
          content="Energieffektive modulhus og modulbaserte badstuer. Fullsyklus trehuskonstruksjon med bindingsverk. Demohus tilgjengelig for visning og kjøp eller individuell prosjektutvikling.">
    <meta property="og:description"
          content="Energieffektive modulhus og modulbaserte badstuer. Fullsyklus trehuskonstruksjon med bindingsverk. Demohus tilgjengelig for visning og kjøp eller individuell prosjektutvikling."/>
  @else
    <meta name="description"
          content="Energoefektīvas moduļu mājas un moduļu pirtis. Pilna cikla koka karkasa māju būvniecība. Iespējama demo māju apskate un iegāde vai arī individuāla projekta izstrāde.">
    <meta property="og:description"
          content="Energoefektīvas moduļu mājas un moduļu pirtis. Pilna cikla koka karkasa māju būvniecība. Iespējama demo māju apskate un iegāde vai arī individuāla projekta izstrāde."/>
  @endif
  <meta property="og:url" content=" {{Request::url()}}"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name')}}"/>

  <meta property="og:image" content="{{ asset('storage/logo/mh-og-logo.jpeg') }}"/>

  <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name')}}</title>
  <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>

  @if(App::environment('production'))
    <meta name="facebook-domain-verification" content="6f9uyw6o900t8gvvu9fhtwmn938qse"/>
  @endif
  <script src="{{ mix('/js/app.js') }}" defer></script>
  @if(App::environment('production'))
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DJX1GVY8KK"></script>
    <script> window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }

      gtag('js', new Date());
      gtag('config', 'G-DJX1GVY8KK');

      function trackFormSubmit(event) {
        gtag('event', event, {
          'event_category': event,
          'event_label': 'Submit Form'
        });
      }

    </script>
    <!-- Facebook Pixel Code -->
    <script>
      !function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');

      fbq('init', '1323535588541765');
      fbq('track', 'PageView');
    </script>
    <noscript>
      <img height="1" width="1" style="display:none"
           src="https://www.facebook.com/tr?id=1323535588541765&ev=PageView&noscript=1"/>
    </noscript>
  @endif
</head>
<body class="antialiased" oncontextmenu="return false">
@if(isset($index))
  @include('includes.navbar')
@endif
<div class="content w-100 h-100">
  @yield('content')
</div>
<script async type="text/javascript" src="https://static.klaviyo.com/onsite/js/klaviyo.js?company_id=RFwwRz"></script>
</body>
</html>
