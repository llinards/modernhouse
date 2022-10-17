@extends('app')
@section('content')
{{--  @include('includes.navbar-desktop', ['index' => false])--}}
  @include('includes.navbar-mobile', ['index' => false])
  <div class="container-xxl content">
    <div class="row">
      <div class="title">
        <h1 class="fw-bold text-center text-uppercase">{{ $product->name }}</h1>
      </div>
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
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{Str::slug($variant->name)}}">
              <div class="row">
                <div class="col-lg-7 mt-4">
                  <section id="{{Str::slug($variant->name)}}-main-carousel" class="splide">
                    <div class="splide__track">
                      <ul class="splide__list">
                        @foreach($product->productVariantImages as $image)
                          @if($image->product_variant_id === $variant->id)
                            <li class="splide__slide">
                              <img class="img-fluid" src="{{ asset('storage/product-images/'.Str::slug($product->name)).'/'.Str::slug($variant->name).'/'.$image->filename }}" alt="">
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
                <div class="col-lg-5 mt-4 d-flex flex-column">
                  <div class="product-short-description">
                    <p>{{ $variant->description }}</p>
                  </div>
                  <div>
                    <h4 class="fw-bold text-center mt-4 mb-2">Choose your variant:</h4>
                    <div class="product-variant-options">
                      <ul class="nav nav-tabs d-flex product-variant-option-titles flex-nowrap">
                        <li class="nav-item">
                          <button class="nav-link active product-variant-option-title" id="basic-variant-title" data-bs-toggle="tab" data-bs-target="#basic-{{Str::slug($variant->name)}}" type="button">Basic</button>
                        </li>
                        <li class="nav-item">
                          <button class="nav-link product-variant-option-title" id="full-variant-title" data-bs-toggle="tab" data-bs-target="#full-{{Str::slug($variant->name)}}" type="button">Full</button>
                        </li>
                      </ul>
                      <div class="tab-content product-variant-option mt-2">
                        <div class="tab-pane fade show active" id="basic-{{Str::slug($variant->name)}}">
                          <div class="accordion accordion-flush">
                            @foreach($product->productVariantOptions as $option)
                              @if($option->product_variant_id === $variant->id)
                                <div class="accordion-item">
                                  <h2 class="accordion-header">
                                    <button class="accordion-button collapsed variant-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{Str::slug($option->option_type)}}" aria-expanded="false" aria-controls="{{Str::slug($option->option_type)}}">
                                      {{ $option->option_type }}
                                    </button>
                                  </h2>
                                  <div id="{{Str::slug($option->option_type)}}" class="accordion-collapse collapse product-variant-option-content">
                                    <div class="accordion-body">
                                      <ul class="list-group list-group-flush">
                                        {!! $option->options_basic !!}
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              @endif
                            @endforeach
                          </div>
                          <div class="product-price mt-2 mb-5">
                            <h1 class="text-center">EUR {{ number_format($variant->price_basic, 2, ',', ' ') }}</h1>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="full-{{Str::slug($variant->name)}}">
                          <div class="accordion accordion-flush">
                            @foreach($product->productVariantOptions as $option)
                              @if($option->product_variant_id === $variant->id)
                                <div class="accordion-item">
                                  <h2 class="accordion-header">
                                    <button class="accordion-button collapsed variant-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{Str::slug($option->option_type)}}" aria-expanded="false" aria-controls="{{Str::slug($option->option_type)}}">
                                      {{ $option->option_type }}
                                    </button>
                                  </h2>
                                  <div id="{{Str::slug($option->option_type)}}" class="accordion-collapse collapse product-variant-option-content">
                                    <div class="accordion-body">
                                      <ul class="list-group list-group-flush">
                                        {!! $option->options_full !!}
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              @endif
                            @endforeach
                          </div>
                          <div class="product-price mt-2 mb-5">
                            <h1 class="text-center">EUR {{ number_format($variant->price_full, 2, ',', ' ') }}</h1>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product-order d-flex flex-column align-items-center">
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
  <script>

  </script>
@endsection
