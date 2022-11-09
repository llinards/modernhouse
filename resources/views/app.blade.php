<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="author" content="{{ config('app.name') }}">
    <meta name="description" content="">

    <meta property="og:url" content=" {{Request::url()}}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name')}}" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="{{ asset('storage/logo-black.svg') }}" />

    <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name')}}</title>
      <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
      @if(!isset($index))
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
      @endif
      <script src="{{ mix('/js/app.js') }}" defer></script>
  </head>
  <body class="antialiased">
      @if(isset($index))
        @include('includes.navbar')
      @endif
      <div class="content w-100 h-100">
        @yield('content')
      </div>
  </body>
</html>
