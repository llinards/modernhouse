<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('includes.layout-head')
</head>
<body class="antialiased" oncontextmenu="return false">
<div class="content">
  {{ $slot }}
</div>
@cookieconsentview
</body>
</html>
