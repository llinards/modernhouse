<!DOCTYPE html>
<html class="h-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <title>{{ config('app.name')}}</title>

  <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>
  <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body class="antialiased h-100">
<div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center">
    <div class="col-lg-6">
      {{ $slot }}
    </div>
  </div>
</div>
</body>
</html>
