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
        {{ $slot }}
      </div>
    </div>
  </div>
  @include('includes.footer')
</div>
</body>
</html>
