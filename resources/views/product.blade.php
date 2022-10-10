@extends('app')
@section('content')
  @include('includes.navbar-desktop', ['index' => false])
  @include('includes.navbar-mobile', ['index' => false])
  <div class="container-xxl content">
    <div class="row">
      <div class="title">
        <h1 class="fw-bold text-center text-uppercase">{{ $product->name }}</h1>
      </div>
      <div class="product-levels">
        <ul class="nav mt-4 nav-tabs d-flex product-level-titles flex-nowrap">
          @if(count($product->productOptions) !== 1)
            @foreach($product->productOptions as $option)
              <li class="nav-item">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#{{Str::slug($option->name)}}" type="button">{{ $option->name }}</button>
              </li>
            @endforeach
          @endif
        </ul>
        <div class="tab-content product-level">
          @foreach($product->productOptions as $option)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{Str::slug($option->name)}}">
              <div class="row">
                <div class="col-lg-7 mt-4">
                  <section id="{{Str::slug($option->name)}}-main-carousel" class="splide">
                    <div class="splide__track">
                      <ul class="splide__list">
                        @foreach($product->productImages as $image)
                          @if($image->option_id === $option->id)
                            <li class="splide__slide">
                              <img class="img-fluid" src="{{ asset('storage/product-images/'.Str::slug($product->name)).'/'.Str::slug($option->name).'/'.$image->filename }}" alt="">
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </section>
                  <section id="{{Str::slug($option->name)}}-thumbnail-carousel" class="splide mt-2">
                    <div class="splide__track">
                      <ul class="splide__list">
                        @foreach($product->productImages as $image)
                          @if($image->option_id === $option->id)
                            <li class="splide__slide">
                              <img class="img-fluid" data-splide-lazy="{{ asset('storage/product-images/'.Str::slug($product->name)).'/'.Str::slug($option->name).'/'.$image->filename }}"/>
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </section>
                </div>
                <div class="col-lg-5 mt-4 d-flex flex-column justify-content-around">
                  <div class="product-short-description">
                    <p>{{ $option->description }}</p>
                  </div>
                  <div class="product-price">
                    <h1 class="text-center">EUR {{ $option->price }}</h1>
                  </div>
                  <div class="product-order d-flex flex-column justify-content-end align-items-center">
                    <h4 class="fw-bold text-center mb-2">Order your Model 1</h4>
                    <button
                      class="btn btn-primary btn-main btn-secondary fw-light d-flex justify-content-center align-items-center text-uppercase">@lang('order
                      now')</button>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
