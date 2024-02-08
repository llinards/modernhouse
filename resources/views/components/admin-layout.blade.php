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

  <meta property="og:url" content=" {{Request::url()}}"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name')}}"/>
  <meta property="og:image" content="{{ asset('storage/logo/mh-og-logo.jpeg') }}"/>

  <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name')}}</title>
  <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>
  {{--TODO: Move this to NPM--}}
  <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>

  <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body class="antialiased">
<div class="container">
  @include('includes.admin-navbar')
  <section>
    <div class="mt-5">
      <h2 class="text-center">
        {{ $header }}
      </h2>
    </div>
    <div class="my-5">
      <div class="container">
        {{ $content }}
      </div>
    </div>
  </section>
</div>
</body>
</html>
