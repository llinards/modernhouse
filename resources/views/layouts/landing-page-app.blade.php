<!DOCTYPE html>
<html class="h-100 w-100 overflow-x-hidden" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('includes.layout-head')
</head>
<body class="antialiased w-100 h-100 overflow-x-hidden" oncontextmenu="return false">
@yield('content')
{{--@include('includes.open-days-invitation-modal')--}}
</body>
</html>
