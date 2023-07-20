@extends('app', ['title' => Lang::get('privacy-policy'), 'index' => false, 'allProducts' => $allProducts])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('privacy-policy')</h1>
      <div class="mt-4">
        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center align-items-start flex-column">
            @lang('privacy policy')
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('includes.footer')
@endsection
