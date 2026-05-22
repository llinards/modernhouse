@props(['title' => null, 'description' => null, 'ogImage' => null, 'ogType' => 'website', 'robots' => null])
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
@if(!empty($promoModal))
  @include('includes.promo-modal')
@endif
@cookieconsentview
</body>
</html>
