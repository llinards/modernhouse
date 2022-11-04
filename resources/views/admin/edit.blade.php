@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section class="all-products">
      <div class="all-products-title my-5">
        <h2 class="text-center">Rediģēt - {{ $product->name }}</h2>
      </div>
      <div class="all-products-content">
        <div class="container">
          <div class="row justify-content-between">

          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
