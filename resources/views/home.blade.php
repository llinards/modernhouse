@extends('app')
@section('content')
  @include('includes.navbar-desktop')
  @include('includes.navbar-mobile')
  <article class="scroller">
    <section id="model-one" class="vh-100">
      <div class="container w-100 h-100 d-flex flex-column justify-content-evenly">
        <div class="title">
          <h1 class="fw-bold text-center">Model 1</h1>
        </div>
        <div class="text-center d-flex flex-column align-items-center justify-content-center">
          <a href="#" class="btn btn-primary">Order Now</a>
          <a href="#model-two" class="pt-3">
            <img width="50" src="{{ asset('storage/arrow-down.svg') }}" alt="Arrow down">
          </a>
        </div>
      </div>
    </section>
    <section id="model-two" class="vh-100">
      <div class="container w-100 h-100 d-flex flex-column justify-content-evenly">
        <div class="title">
          <h1 class="fw-bold text-center">Model 2</h1>
        </div>
        <div class="text-center d-flex flex-column align-items-center justify-content-center">
          <a href="#" class="btn btn-primary">Order Now</a>
          <a href="#model-three" class="pt-3">
            <img width="50" src="{{ asset('storage/arrow-down.svg') }}" alt="">
          </a>
        </div>
      </div>
    </section>
    <section id="model-three" class="vh-100">
      <div class="container w-100 h-100 d-flex flex-column justify-content-evenly">
        <div class="title">
          <h1 class="fw-bold text-center">Model 3</h1>
        </div>
        <div class="text-center d-flex flex-column align-items-center justify-content-center">
          <a href="#" class="btn btn-primary">Order Now</a>
          <a href="#model-two" class="pt-3">
            <img width="50" class="arrow-up" src="{{ asset('storage/arrow-down.svg') }}" alt="">
          </a>
        </div>
      </div>
    </section>
  </article>
@endsection
