<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="author" content="{{ config('app.name') }}">
  <meta name="description"
        content="{{ isset($short_description) ? $short_description : 'Energoefektīvas moduļu mājas un moduļu pirtis. Pilna cikla koka karkasa māju būvniecība. Iespējama demo māju apskate un iegāde vai arī individuāla projekta izstrāde.' }}">

  <meta property="og:url" content=" {{Request::url()}}"/>
  <meta property="og:type" content="website"/>
  <meta property="og:title" content="{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name')}}"/>
  <meta property="og:description"
        content="{{ isset($short_description) ? $short_description : 'Energoefektīvas moduļu mājas un moduļu pirtis. Pilna cikla koka karkasa māju būvniecība. Iespējama demo māju apskate un iegāde vai arī individuāla projekta izstrāde.' }}"/>
  <meta property="og:image" content="{{ asset('storage/logo/mh-og-logo.jpeg') }}"/>

  <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name')}}</title>
  <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>
  @if(!isset($index))
    <script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script
      src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script
      src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
  @endif
  <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body class="antialiased" oncontextmenu="return false">
@if(isset($index))
  @include('includes.navbar')
@endif
<div class="content w-100 h-100">
  @yield('content')
</div>
</body>
</html>
