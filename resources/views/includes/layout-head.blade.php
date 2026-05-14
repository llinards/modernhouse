@php
    $locale = app()->getLocale();
    $supportedLocales = array_keys(config('app.languages'));

    $defaultDescriptions = [
        'en' => 'Energy-efficient modular houses and modular saunas. Full cycle timber frame house construction. Demo houses available for viewing and purchase or individual project development.',
        'se' => 'Energieffektiva modulhus och modulbastur. Helcykelkonstruktion av hus med trästomme. Demonstrationshus tillgängliga för visning och köp eller individuell projektutveckling.',
        'no' => 'Energieffektive modulhus og modulbaserte badstuer. Fullsyklus trehuskonstruksjon med bindingsverk. Demohus tilgjengelig for visning og kjøp eller individuell prosjektutvikling.',
        'lv' => 'Energoefektīvas moduļu mājas un moduļu pirtis. Pilna cikla koka karkasa māju būvniecība. Iespējama demo māju apskate un iegāde vai arī individuāla projekta izstrāde.',
    ];

    $metaDescription = $description ?? $defaultDescriptions[$locale] ?? $defaultDescriptions['lv'];
    $metaTitle = isset($title) ? $title . ' | ' . config('app.name') : config('app.name');
    $canonical = url()->current();
    $ogImageUrl = isset($ogImage) ? asset($ogImage) : asset('storage/logo/mh-og-logo.jpeg');

    $hreflangMap = [
        'lv' => 'lv',
        'en' => 'en',
        'se' => 'sv',
        'no' => 'no',
    ];
    $ogLocaleMap = [
        'lv' => 'lv_LV',
        'en' => 'en_US',
        'se' => 'sv_SE',
        'no' => 'nb_NO',
    ];

    $segments = request()->segments();
    $buildLocaleUrl = function (string $newSlug) use ($segments) {
        if (count($segments) === 0) {
            return url('/' . $newSlug);
        }
        $copy = $segments;
        $copy[0] = $newSlug;
        return url('/' . implode('/', $copy));
    };
@endphp
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<meta name="theme-color" content="#000000">
<meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">

<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
<meta name="author" content="{{ config('app.name') }}">
<link rel="canonical" href="{{ $canonical }}">
<meta name="robots" content="{{ $robots ?? 'index, follow, max-image-preview:large' }}">

@foreach($supportedLocales as $slug)
  <link rel="alternate" hreflang="{{ $hreflangMap[$slug] ?? $slug }}" href="{{ $buildLocaleUrl($slug) }}">
@endforeach
<link rel="alternate" hreflang="x-default" href="{{ $buildLocaleUrl(config('app.locale')) }}">

<meta property="og:type" content="{{ $ogType ?? 'website' }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $ogImageUrl }}">
<meta property="og:image:alt" content="{{ $metaTitle }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="{{ $ogLocaleMap[$locale] ?? 'lv_LV' }}">
@foreach($supportedLocales as $slug)
  @if($slug !== $locale)
    <meta property="og:locale:alternate" content="{{ $ogLocaleMap[$slug] ?? $slug }}">
  @endif
@endforeach

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $ogImageUrl }}">
<meta name="twitter:image:alt" content="{{ $metaTitle }}">

@vite(['resources/js/app.js', 'resources/sass/app.scss'])
<meta name="facebook-domain-verification" content="6f9uyw6o900t8gvvu9fhtwmn938qse"/>
<script>
  if (typeof window.trackFormSubmit === 'undefined') { window.trackFormSubmit = function() {}; }
  if (typeof window.fbq === 'undefined') { window.fbq = function() {}; }
</script>
@cookieconsentscripts
