<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('includes.layout-head')
</head>
<body class="antialiased" oncontextmenu="return false">
@include('includes.navbar')
<div class="content"
     style="min-height:calc(100vh - 131px);display:flex;flex-direction: column;justify-content:space-between;">
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
<script async type="text/javascript" src="https://static.klaviyo.com/onsite/js/klaviyo.js?company_id=RFwwRz"></script>
</body>
</html>
