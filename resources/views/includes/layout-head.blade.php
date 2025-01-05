<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">

<meta name="author" content="{{ config('app.name') }}">
<meta name="locale" content="{{ app()->getLocale() }}">
<meta name="description"
      content="Energy-efficient modular houses and modular saunas. Full cycle timber frame house construction. Demo houses available for viewing and purchase or individual project development.">
<meta property="og:description"
      content="Energy-efficient modular houses and modular saunas. Full cycle timber frame house construction. Demo houses available for viewing and purchase or individual project development."/>
<meta property="og:url" content=" {{Request::url()}}"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name')}}"/>

<meta property="og:image" content="{{ asset('storage/logo/mh-og-logo.jpeg') }}"/>

<title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name')}}</title>
<link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>
@if(App::environment('production'))

@endif
<script src="{{ mix('/js/app.js') }}" defer></script>
@if(App::environment('production'))

@endif
