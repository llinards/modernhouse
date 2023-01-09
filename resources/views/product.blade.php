@extends('app', ['title' => $product->name, 'index' => false, 'allProducts' => $allProducts])
@section('content')
  <div class="container-xxl">
    <div class="row">
      <div class="title">
        <h1 class="fw-bold text-center text-uppercase">{{ $product->name }}</h1>
      </div>
      @include('includes.status-messages')
      <div class="product-variants-options">
        <ul class="nav mt-4 nav-tabs d-flex product-variant-titles flex-nowrap">
          @if(count($product->productVariants) !== 1)
            @foreach($product->productVariants as $variant)
              <li class="nav-item">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#{{Str::slug($variant->name)}}" type="button">{{ $variant->name }}</button>
              </li>
            @endforeach
          @endif
        </ul>
        <div class="tab-content product-variant">
          @foreach($product->productVariants as $variant)
            <div class="tab-pane product-variant-tab fade {{ $loop->first ? 'show active' : '' }}" id="{{Str::slug($variant->name)}}">
              <div class="row">
                <div class="col-lg-7 mt-4">
                  <section id="{{Str::slug($variant->name)}}-main-carousel" class="splide">
                    <div class="splide__track">
                      <ul class="splide__list">
                        @foreach($product->productVariantImages as $image)
                          @if($image->product_variant_id === $variant->id)
                            <li class="splide__slide">
                              <img class="img-fluid" data-splide-lazy="{{ asset('storage/product-images/'.Str::slug($product->name)).'/'.Str::slug($variant->name).'/'.$image->filename }}" alt="">
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </section>
                  <section id="{{Str::slug($variant->name)}}-thumbnail-carousel" class="splide mt-2">
                    <div class="splide__track">
                      <ul class="splide__list">
                        @foreach($product->productVariantImages as $image)
                          @if($image->product_variant_id === $variant->id)
                            <li class="splide__slide">
                              <img class="img-fluid" data-splide-lazy="{{ asset('storage/product-images/'.Str::slug($product->name)).'/'.Str::slug($variant->name).'/'.$image->filename }}"/>
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </section>
                </div>
                <div class="col-lg-5 mt-4 d-flex flex-column justify-content-between">
                  <div>
                    <div class="title">
                      <h2 class="fw-bold text-center">Izvēlies komplektāciju</h2>
                    </div>
                    <ul class="nav nav-tabs d-flex product-variant-option-titles flex-nowrap">
                      <li class="nav-item">
                        <button class="nav-link active product-variant-option-title basic-variant-title" data-bs-toggle="tab" data-bs-target="#basic-{{Str::slug($variant->name)}}" type="button">Rūpnīcas</button>
                      </li>
                      <li class="nav-item">
                        <button class="nav-link product-variant-option-title full-variant-title" data-bs-toggle="tab" data-bs-target="#full-{{Str::slug($variant->name)}}" type="button">Pilna</button>
                      </li>
                    </ul>
                    <div class="product-price mt-4 mb-2">
                      <div class="title">
                        <h2 class="text-center fw-bold basic-variant-price">EUR {{ number_format($variant->price_basic, 2, ',', ' ') }}</h2>
                        <h2 class="text-center fw-bold full-variant-price visually-hidden">EUR {{ number_format($variant->price_full, 2, ',', ' ') }}</h2>
                      </div>
                    </div>
                    <div class="product-short-description">
                      <p>{!! $variant->description !!}</p>
                      <div class="product-details">
                        <div class="product-details-header d-flex justify-content-between">
                          <p class="text-start">Dzīvojamā platība: 40,95m<sup>2</sup></p>
                          <p class="text-end">Apbūves platība: 52m<sup>2</sup></p>
                        </div>
                        <hr class="m-1">
                        <ul class="product-details-content p-0 m-0">
                          <li class="d-flex justify-content-between">
                            <div>
                              <img src="{{ asset('storage/check.svg') }}"/>Guļamistabas
                            </div>
                            <div>
                              <img src="{{ asset('storage/bed.svg') }}"/>2
                            </div>
                          </li>
                          <li class="d-flex justify-content-between">
                            <div>
                              <img src="{{ asset('storage/check.svg') }}"/>Viesistaba ar virtuves zonu
                            </div>
                            <div>
                              <img src="{{ asset('storage/fork-knife.svg') }}"/>1
                            </div>
                          </li>
                          <li class="d-flex justify-content-between">
                            <div>
                              <img src="{{ asset('storage/check.svg') }}"/>Vannas istaba
                            </div>
                            <div>
                              <img src="{{ asset('storage/bathtub.svg') }}"/>1
                            </div>
                          </li>
                          <li class="d-flex justify-content-between">
                            <div>
                              <img src="{{ asset('storage/negative.svg') }}"/>Lofts
                            </div>
                            <div>
                              <img src="{{ asset('storage/ladder-simple.svg') }}"/>
                            </div>
                          </li>
                          <li class="d-flex justify-content-between">
                            <div>
                              <img src="{{ asset('storage/check.svg') }}"/>Sauna
                            </div>
                            <div>
                              <img src="{{ asset('storage/leaf.svg') }}"/>1
                            </div>
                          </li>
                          <li class="d-flex justify-content-between">
                            <div>
                              <img src="{{ asset('storage/check.svg') }}"/>Terase
                            </div>
                            <div>
                              <img src="{{ asset('storage/selection-plus.svg') }}"/>1
                            </div>
                          </li>
                        </ul>
                        <hr class="m-1 mb-3">
                      </div>
                    </div>
                  </div>
                  <div class="product-order d-flex flex-column align-items-center">
                    <button
                      class="btn btn-primary fw-light d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#request-product-info">@lang('customer order')</button>
                  </div>
                </div>
                <div class="tab-content product-variant-option mt-4">
                  <h4 class="fw-bold text-center my-2">Tehniskās specifikācijas</h4>
                  <div class="tab-pane fade show active" id="basic-{{Str::slug($variant->name)}}">
                    <div class="accordion accordion-flush">
                      @foreach($product->productVariantOptions as $option)
                        @if($option->product_variant_id === $variant->id && $option->option_category === 'Basic')
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed variant-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{Str::slug($option->option_title)}}" aria-expanded="false" aria-controls="{{Str::slug($option->option_title)}}">
                                {{ $option->option_title }}
                              </button>
                            </h2>
                            <div id="{{Str::slug($option->option_title)}}" class="accordion-collapse collapse product-variant-option-content">
                              <div class="accordion-body">
                                <ul class="list-group list-group-flush">
                                  {!! $option->options !!}
                                </ul>
                              </div>
                            </div>
                          </div>
                        @endif
                      @endforeach
                    </div>
                  </div>
                  <div class="tab-pane fade" id="full-{{Str::slug($variant->name)}}">
                    <div class="accordion accordion-flush">
                      @foreach($product->productVariantOptions as $option)
                        @if($option->product_variant_id === $variant->id && $option->option_category === 'Full')
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed variant-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{Str::slug($option->option_title)}}" aria-expanded="false" aria-controls="{{Str::slug($option->option_title)}}">
                                {{ $option->option_title }}
                              </button>
                            </h2>
                            <div id="{{Str::slug($option->option_title)}}" class="accordion-collapse collapse product-variant-option-content">
                              <div class="accordion-body">
                                <ul class="list-group list-group-flush">
                                  {!! $option->options !!}
                                </ul>
                              </div>
                            </div>
                          </div>
                        @endif
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
          @include('includes.request-product-info-modal', [$product])
        </div>
      </div>
    </div>
  </div>
  <script>
    const basicVariantBtn = document.querySelectorAll('.basic-variant-title');
    const fullVariantBtn = document.querySelectorAll('.full-variant-title');

    const basicVariantPrice = document.querySelectorAll('.basic-variant-price');
    const fullVariantPrice = document.querySelectorAll('.full-variant-price');

    basicVariantBtn.forEach(item => {
      item.addEventListener('click', (e) => {
        basicVariantPrice.forEach(item => {
          item.classList.remove('visually-hidden');
        });
        fullVariantPrice.forEach(item => {
          item.classList.add('visually-hidden');
        });
      });
    });

    fullVariantBtn.forEach(item => {
      item.addEventListener('click', (e) => {
        fullVariantPrice.forEach(item => {
          item.classList.remove('visually-hidden');
        });
        basicVariantPrice.forEach(item => {
          item.classList.add('visually-hidden');
        });
      });
    });
  </script>
@endsection
