@extends('app', ['index' => true, 'allProducts' => $allProducts])
@section('content')
  <article id="home">
    @foreach($allProducts as $key => $product)
      <section id="{{$product->slug}}" class="d-flex flex-column justify-content-between" style="background-image: url('{{ asset('storage/product-images/'.$product->slug.'/'.$product->cover_photo_filename)}}')">
        <div class="title">
          <h1 class="fw-bold text-center text-uppercase">{{ $product->name }}</h1>
        </div>
        <div class="order-now text-center d-flex flex-column justify-content-end align-items-center">
          <a href="/{{ $product->slug }}" class="btn btn-primary fw-light d-flex justify-content-center align-items-center ">@lang('feature details')</a>
          @php
            ++$key;
          @endphp
          <a href="#{{ $loop->last ? 'next' : $allProducts[$key]->slug }}" class="pb-lg-5 pb-4 pt-3">
            <img width="35" height="35" src="{{ asset('storage/arrow-down.svg') }}" alt="Arrow down">
          </a>
        </div>
      </section>
    @endforeach
    <section id="next" class="d-flex justify-content-center align-items-center flex-column">
        <div>
          <div class="text-center">
            <img src="{{ asset('storage/house-line.png') }}"/>
          </div>
          <h2 class="text-uppercase text-center">izvēlies</h2>
          <p class="text-center">Iepazīsties un izvēlies sev labāko variantu.</p>
        </div>
        <div>
          <div class="text-center">
            <img src="{{ asset('storage/checks.png') }}"/>
          </div>
          <h2 class="text-uppercase text-center">pasūti</h2>
          <p class="text-center">Veic pasūtījumu mūsu pieteikuma anketā.</p>
        </div>
        <div>
          <div class="text-center">
            <img src="{{ asset('storage/handshake.png') }}"/>
          </div>
          <h2 class="text-uppercase text-center">sazinamies</h2>
          <p class="text-center">Mēs ar Tevi sazināsimies!</p>
        </div>
      </section>
    @include('includes.footer')
  </article>
@endsection
