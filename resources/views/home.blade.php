@extends('app', ['index' => true])
@section('content')
  <article id="home">
    <section id="introduction-video" class="d-flex flex-column justify-content-between position-relative">
      <video playsinline autoplay muted loop poster="{{asset('storage/introduction-video/video-cover.jpg')}}">
        <source src="{{asset('storage/introduction-video/introduction-video.mp4')}}" type="video/mp4">
      </video>
      <h2 class="fw-bold text-center text-uppercase title z-1">@lang('introduction-title')</h2>
      <div class="d-flex flex-column align-items-center z-1">
        <a href="/{{ app()->getLocale()}}/request-consultation"
           class="btn btn-secondary fw-light d-flex justify-content-center align-items-center"
        >@lang('request consultation')</a>
        <a href="#{{ $allActiveProducts[0]->slug }}"
           class="pb-lg-5 pb-4 pt-3">
          <img width="35" height="35" src="{{ asset('storage/icons/arrow-down.svg') }}" alt="Arrow down">
        </a>
      </div>
    </section>
    @foreach($allActiveProducts as $key => $product)
      <section id="{{$product->slug}}" class="d-flex flex-column justify-content-between"
               style="background-image: url('{{ asset('storage/product-images/'.$product->slug.'/'.$product->cover_photo_filename)}}')">
        <h1 class="fw-bold text-center text-uppercase title">{{ $product->translations[0]->name }}</h1>
        <div class="text-center d-flex flex-column justify-content-end align-items-center">
          <a href="/{{ app()->getLocale()}}/{{$product->slug }}"
             class="btn btn-secondary fw-light d-flex justify-content-center align-items-center mb-2">@lang('feature details')</a>
          <a href="/{{ app()->getLocale()}}/request-consultation"
             class="btn btn-secondary fw-light d-flex justify-content-center align-items-center"
          >@lang('request consultation')</a>
          @php
            ++$key;
          @endphp
          <a href="#{{ $loop->last ? 'choose-order-contact' : $allActiveProducts[$key]->slug }}"
             class="pb-lg-5 pb-4 pt-3">
            <img width="35" height="35" src="{{ asset('storage/icons/arrow-down.svg') }}" alt="Arrow down">
          </a>
        </div>
      </section>
    @endforeach
    <section id="choose-order-contact" class="d-flex justify-content-center align-items-center flex-column">
      <div class="m-2">
        <div class="text-center">
          <img src="{{ asset('storage/icons/house-line.png') }}"/>
        </div>
        <h2 class="text-uppercase text-center">@lang('choose order contact title 1')</h2>
        <p class="text-center">@lang('choose order contact text 1')</p>
      </div>
      <div class="m-2">
        <div class="text-center">
          <img src="{{ asset('storage/icons/checks.png') }}"/>
        </div>
        <h2 class="text-uppercase text-center">@lang('choose order contact title 2')</h2>
        <p class="text-center">@lang('choose order contact text 2')</p>
      </div>
      <div class="m-2">
        <div class="text-center">
          <img src="{{ asset('storage/icons/handshake.png') }}"/>
        </div>
        <h2 class="text-uppercase text-center">@lang('choose order contact title 3')</h2>
        <p class="text-center">@lang('choose order contact text 2')</p>
      </div>
    </section>
    <section id="footer">
      @include('includes.footer')
    </section>
  </article>
@endsection
