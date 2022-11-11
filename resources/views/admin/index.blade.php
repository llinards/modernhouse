@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section class="all-products">
      <div class="all-products-title my-5">
        <h2 class="text-center">Visas mājas/moduļi</h2>
      </div>
      <div class="all-products-content">
        <div class="container">
          <div class="row justify-content-between">
            @include('includes.status-messages')
            @foreach($allProducts as $product)
              <div class="col-lg-4 p-2">
                <div class="card position-relative">
                  <div class="position-absolute">
                    <span class="badge {{ $product->is_active ? 'text-bg-success' : 'text-bg-danger' }}">{{ $product->is_active ? 'Aktīvs' : ' Nav aktīvs' }}</span>
                  </div>
                  <img src="{{ asset('storage/product-images/'.$product->slug.'/'.$product->cover_photo_filename)}}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h4 class="card-title text-center border-bottom">{{ $product->name }}</h4>
                    @if(count($product->productVariants) != 0)
                      <p class="text-center">Varianti</p>
                      @foreach($product->productVariants as $variant)
                      <div class="my-1 text-center">
                        <h5 class="mb-2">{{ $variant->name }}</h5>
                        <a href="/admin/product-variant/{{ $variant->id }}/edit" class="btn btn-secondary btn-sm">Rediģēt</a>
                      </div>
                      @endforeach
                    @else
                      <p>Nav pievienoti varianti.</p>
                    @endif
                    <div class="all-products-content-buttons d-flex justify-content-between mt-4">
                      <a href="/admin/{{ $product->slug }}/edit" class="btn btn-secondary">Rediģēt</a>
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
