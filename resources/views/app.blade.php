<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name')}}</title>
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <script src="{{ mix('/js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        @include('includes.navbar')
        <div class="content w-100 h-100">
          @yield('content')
        </div>
    </body>
</html>
