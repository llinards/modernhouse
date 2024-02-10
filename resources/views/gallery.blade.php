@extends('layouts.app', ['title' => Lang::get('gallery'), 'index' => false])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('gallery')</h1>
      <livewire:index-gallery/>
    </div>
  </div>
  @include('includes.footer')
@endsection

