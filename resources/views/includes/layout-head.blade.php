<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">

<meta name="author" content="{{ config('app.name') }}">
<meta name="locale" content="{{ app()->getLocale() }}">
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
@vite(['resources/js/app.js', 'resources/sass/app.scss'])
<meta name="facebook-domain-verification" content="6f9uyw6o900t8gvvu9fhtwmn938qse"/>
<script>
  if (typeof window.trackFormSubmit === 'undefined') { window.trackFormSubmit = function() {}; }
  if (typeof window.fbq === 'undefined') { window.fbq = function() {}; }
</script>
@cookieconsentscripts
