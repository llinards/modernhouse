<!DOCTYPE html>
<html class="h-100 w-100 overflow-x-hidden" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('includes.layout-head')
</head>
<body class="antialiased h-100 w-100 overflow-x-hidden" oncontextmenu="return false">
@include('includes.navbar', ['home' => true])
<div class="content w-100 h-100">
  {{ $slot }}
</div>
</body>
</html>
