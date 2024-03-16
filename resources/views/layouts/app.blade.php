<!DOCTYPE html>
<html class="h-100 w-100 overflow-x-hidden" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('includes.layout-head')
</head>
<body class="antialiased h-100 w-100 overflow-x-hidden" oncontextmenu="return false">
@if(isset($index))
  @include('includes.navbar')
@endif
<div class="content w-100 h-100">
  @yield('content')
</div>
<script async type="text/javascript" src="https://static.klaviyo.com/onsite/js/klaviyo.js?company_id=RFwwRz"></script>
</body>
</html>
