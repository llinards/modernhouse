@extends('layouts.app', ['title' => $product->translations[0]->name, 'index' => false])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">{{ $product->translations[0]->name }}</h1>
      @include('includes.status-messages')
      <div>
        <ul class="nav mt-4 nav-tabs d-flex product-variant-titles">
          @if(count($productVariants) !== 1)
            @foreach($productVariants as $productVariant)
              <li class="nav-item">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                        data-bs-target="#{{$productVariant->slug}}"
                        type="button">{{ $productVariant->translations[0]->name}}</button>
              </li>
            @endforeach
          @endif
        </ul>
        <div class="tab-content">
          @foreach($productVariants as $productVariant)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                 id="{{$productVariant->slug}}">
              <div class="row">
                <div class="col-lg-7 mt-4">
                  <section id="{{$productVariant->slug}}-main-carousel" class="splide">
                    <div class="splide__track">
                      <ul class="splide__list">
                        @foreach($productVariant->productVariantImages as $image)
                          @if($image->product_variant_id === $productVariant->id)
                            <li class="splide__slide">
                              <a data-fslightbox="{{$productVariant->slug}}"
                                 href="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/'.$image->filename) }}">
                                <img class="img-fluid"
                                     data-splide-lazy="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/'.$image->filename) }}"
                                     alt="{{ $productVariant->{'name_'.app()->getLocale()} }}">
                              </a>
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </section>
                  <section id="{{$productVariant->slug}}-thumbnail-carousel" class="splide mt-2">
                    <div class="splide__track">
                      <ul class="splide__list">
                        @foreach($productVariant->productVariantImages as $image)
                          @if($image->product_variant_id === $productVariant->id)
                            <li class="splide__slide">
                              <img class="img-fluid"
                                   data-splide-lazy="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/'.$image->filename) }}"
                                   alt="{{ $productVariant->{'name_'.app()->getLocale()} }}"/>
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </section>
                </div>
                <div class="col-lg-5 mt-4 d-flex flex-column justify-content-between">
                  <div>
                    <h2 class="fw-bold text-center title">@lang('choose option')</h2>
                    <x-product-variant-option-buttons :productVariant="$productVariant"/>
                    <div class="mt-4 mb-2">
                      <h2
                        class="text-center fw-bold basic-variant-price title show active basic-{{$productVariant->slug}}">
                        @if($productVariant->price_basic != 0.00)
                          EUR {{ number_format($productVariant->price_basic, 2, ',', ' ') }}
                        @else
                          @lang('individual price')
                        @endif
                      </h2>
                      <h2 class="text-center fw-bold full-variant-price title full-{{$productVariant->slug}}">
                        @if($productVariant->price_full != 0.00)
                          EUR {{ number_format($productVariant->price_full, 2, ',', ' ') }}
                        @else
                          @lang('individual price')
                        @endif
                      </h2>
                    </div>
                    <div class="product-short-description">
                      <p>{!! $productVariant->translations[0]->description !!}</p>
                      <div class="product-details">
                        <div class="product-details-header d-flex justify-content-between">
                          <p>@lang('living space') : {{ $productVariant->living_area }} m<sup>2</sup>
                          </p>
                          <p>@lang('construction area') : {{ $productVariant->building_area }}
                            m<sup>2</sup></p>
                        </div>
                        @if($productVariant->productVariantDetails->count() > 0)
                          <hr class="m-1">
                          <ul class="product-details-content p-0 m-0">
                            @foreach($productVariant->productVariantDetails as $productVariantDetail)
                              <li class="d-flex justify-content-between">
                                <div>
                                  <img
                                    src="{{ $productVariantDetail->hasThis ? asset('storage/icons/check.svg') : asset('storage/icons/negative.svg') }}"/>{{ $productVariantDetail->name }}
                                </div>
                                <div>
                                  <img
                                    src="{{ asset('storage/icons/product-variant-detail-icons/'.$productVariantDetail->icon.'.svg') }}"/>
                                  @if($productVariantDetail->count === 0)
                                    <span class="invisible">-</span>
                                  @else
                                    {{ $productVariantDetail->count }}
                                  @endif
                                </div>
                              </li>
                            @endforeach
                          </ul>
                          <hr class="m-1 mb-3">
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="d-flex flex-column align-items-center">
                    <button id="request-product-info-modal"
                            class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
                    >@lang('customer order')</button>
                  </div>
                </div>
                @if(count($productVariant->productVariantOptions) > 0)
                  <h3 class="fw-bold text-center mt-4 mb-1">@lang('tech specs')</h3>
                  <x-product-variant-options :productVariant="$productVariant"/>
                @endif
              </div>
            </div>
          @endforeach
          @include('includes.request-product-info-modal', [$product])
        </div>
      </div>
    </div>
  </div>
  @include('includes.footer')
  <script type="module">
    document.querySelectorAll('button[data-bs-toggle="tab"]').forEach((selectedVariant) => {
      selectedVariant.addEventListener('show.bs.tab', () => {
        const targetClass = selectedVariant.dataset.bsTarget
        const currentVariantPrice = document.querySelector('.' + targetClass.replace('#', ''));
        if (currentVariantPrice) {
          if (currentVariantPrice.nextElementSibling) {
            currentVariantPrice.nextElementSibling.classList.toggle('show');
            currentVariantPrice.nextElementSibling.classList.toggle('active');
          } else if (currentVariantPrice.previousElementSibling) {
            currentVariantPrice.previousElementSibling.classList.toggle('show');
            currentVariantPrice.previousElementSibling.classList.toggle('active');
          }
          currentVariantPrice.classList.toggle('show');
          currentVariantPrice.classList.toggle('active');
        }
      })
    })

    const requestProductInfoModal = new bootstrap.Modal('#request-product-info');
    document.getElementById('request-product-info-modal').addEventListener('click', () => {
      requestProductInfoModal.show();
    })
  </script>
@endsection
