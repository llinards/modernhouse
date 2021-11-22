@extends('app')
@section('content')
  @include('includes.navbar-desktop', ['index' => true])
  @include('includes.navbar-mobile', ['index' => true])
  <article id="home" class="content">
    <section id="model-one">
      <div class="container w-100 h-100 d-flex flex-column">
        <div class="title">
          <h1 class="fw-bold text-center text-uppercase">Model 1</h1>
        </div>
        <div class="order-now text-center d-flex flex-column justify-content-end align-items-center h-100">
          <a href="/product" class="btn btn-primary btn-order-now fw-light d-flex justify-content-center align-items-center">@lang('customer order')</a>
          <a href="#model-two" class="pb-lg-5 pb-4 pt-3">
            <img width="35" height="35" src="{{ asset('storage/arrow-down.svg') }}" alt="Arrow down">
          </a>
        </div>
      </div>
    </section>
    <section id="model-two">
      <div class="container w-100 h-100 d-flex flex-column">
        <div class="title">
          <h1 class="fw-bold text-center text-uppercase">Model 2</h1>
        </div>
        <div class="order-now text-center d-flex flex-column justify-content-end align-items-center h-100">
          <a href="#" class="btn btn-primary btn-order-now fw-light d-flex justify-content-center align-items-center">@lang('customer order')</a>
          <a href="#model-three" class="pb-lg-5 pb-4 pt-3">
            <img width="35" height="35" src="{{ asset('storage/arrow-down.svg') }}" alt="Arrow down">
          </a>
        </div>
      </div>
    </section>
    <section id="model-three">
      <div class="container w-100 h-100 d-flex flex-column">
        <div class="title">
          <h1 class="fw-bold text-center text-uppercase">Model 3</h1>
        </div>
        <div class="order-now text-center d-flex flex-column justify-content-end align-items-center h-100">
          <a href="#" class="btn btn-primary btn-order-now fw-light d-flex justify-content-center align-items-center">@lang('customer order')</a>
          <a href="#model-two" class="pb-lg-5 pb-4 pt-3">
            <img width="35" height="35" class="arrow-up" src="{{ asset('storage/arrow-down.svg') }}" alt="Arrow down">
          </a>
        </div>
      </div>
    </section>
  </article>
@endsection
