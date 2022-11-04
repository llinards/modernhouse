@extends('app', ['index' => true, 'allProducts' => $allProducts])
@section('content')
  <article id="home">
    @foreach($allProducts as $key => $product)
      <section id="{{$product->slug}}" class="d-flex flex-column justify-content-between" style="background-image: url('{{ asset('storage/product-images/'.$product->slug.'/'.$product->cover_photo_filename)}}')">
        <div class="title">
          <h1 class="fw-bold text-center text-uppercase">{{ $product->name }}</h1>
        </div>
        <div class="order-now text-center d-flex flex-column justify-content-end align-items-center">
          <a href="/{{ $product->slug }}" class="btn btn-primary btn-main fw-light d-flex justify-content-center align-items-center ">@lang('feature details')</a>
          @php
            ++$key;
          @endphp
          @if(count($allProducts) !== 1)
            <a href="#{{ $loop->last ? $allProducts[0]->slug : $allProducts[$key]->slug }}" class="pb-lg-5 pb-4 pt-3">
              <img width="35" height="35" class="{{ $loop->last ? 'arrow-up' : '' }}" src="{{ asset('storage/arrow-down.svg') }}" alt="Arrow down">
            </a>
          @endif
        </div>
      </section>
    @endforeach
  </article>
@endsection
