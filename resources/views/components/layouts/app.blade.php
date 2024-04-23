<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('includes.layout-head')
</head>
<body class="antialiased" oncontextmenu="return false">
@include('includes.navbar')
<div class="content">
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="text-center text-uppercase">
        {{ $header }}
      </h1>
      <div class="mt-4">
        {{ $content }}
      </div>
    </div>
  </div>
  @include('includes.footer')
</div>
@if(app()->getLocale() === 'lv')
  @include('includes.register-for-open-days-modal')
@endif
<script async type="text/javascript" src="https://static.klaviyo.com/onsite/js/klaviyo.js?company_id=RFwwRz"></script>
</body>
</html>
