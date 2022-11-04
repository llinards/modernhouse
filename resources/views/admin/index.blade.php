@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section class="all-products">
      <div class="all-products-title mt-5">
        <h2 class="text-center">Visas mājas/moduļi</h2>
      </div>
      <div class="all-products-content">
        <div class="container">
          <div class="row justify-content-between">
            @foreach($allProducts as $product)
              <div class="col-lg-4 p-2 text-center">
                <div class="card position-relative">
                  <div class="position-absolute">
                    <span class="badge {{ $product->is_active ? 'text-bg-success' : 'text-bg-danger' }}">{{ $product->is_active ? 'Aktīvs' : ' Nav aktīvs' }}</span>
{{--                    <span class="badge text-bg-light">1</span>--}}
                  </div>
                  <img src="{{ asset('storage/product-images/'.$product->slug.'/'.$product->cover_photo_filename)}}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <div class="all-products-content-buttons d-flex justify-content-between mt-2">
                      <a href="/admin/{{ $product->slug }}/edit" class="btn btn-warning">Rediģēt</a>
                      <a href="#" class="btn btn-danger">Dzēst</a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
