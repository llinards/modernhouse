@extends('app', ['title' => $product->{'name_'.app()->getLocale()}, 'index' => false])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">{{ $product->{'name_'.app()->getLocale()} }}</h1>
      @include('includes.status-messages')
      <div>
        <ul class="nav mt-4 nav-tabs d-flex product-variant-titles">
          @if(count($product->productVariants) !== 1)
            @foreach($product->productVariants as $variant)
              <li class="nav-item">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                        data-bs-target="#{{Str::slug($variant->slug)}}"
                        type="button">{{ $variant->{'name_'.app()->getLocale()} }}</button>
              </li>
            @endforeach
          @endif
        </ul>
        <div class="tab-content">
          @foreach($product->productVariants as $variant)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{$variant->slug}}">
              <div class="row">
                <div class="col-lg-7 mt-4">
                  <section id="{{$variant->slug}}-main-carousel" class="splide">
                    <div class="splide__track">
                      <ul class="splide__list">
                        @foreach($variant->productVariantImages as $image)
                          @if($image->product_variant_id === $variant->id)
                            <li class="splide__slide">
                              <a data-fslightbox="{{$variant->slug}}"
                                 href="{{ asset('storage/product-images/'.$product->slug.'/'.$variant->slug.'/'.$image->filename) }}">
                                <img class="img-fluid"
                                     data-splide-lazy="{{ asset('storage/product-images/'.$product->slug.'/'.$variant->slug.'/'.$image->filename) }}"
                                     alt="{{ $variant->{'name_'.app()->getLocale()} }}">
                              </a>
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </section>
                  <section id="{{$variant->slug}}-thumbnail-carousel" class="splide mt-2">
                    <div class="splide__track">
                      <ul class="splide__list">
                        @foreach($variant->productVariantImages as $image)
                          @if($image->product_variant_id === $variant->id)
                            <li class="splide__slide">
                              <img class="img-fluid"
                                   data-splide-lazy="{{ asset('storage/product-images/'.$product->slug.'/'.$variant->slug.'/'.$image->filename) }}"
                                   alt="{{ $variant->{'name_'.app()->getLocale()} }}"/>
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
                    <ul class="nav nav-tabs d-flex product-variant-option-titles flex-nowrap">
                      <li class="nav-item">
                        <button class="nav-link active basic-variant-title" data-bs-toggle="tab"
                                data-bs-target="#basic-{{$variant->slug}}" type="button">@lang('basic')
                        </button>
                      </li>
                      <li class="nav-item">
                        <button class="nav-link full-variant-title" data-bs-toggle="tab"
                                data-bs-target="#full-{{$variant->slug}}" type="button">@lang('full')
                        </button>
                      </li>
                    </ul>
                    <div class="mt-4 mb-2">
                      <h2
                        class="text-center fw-bold basic-variant-price title show active basic-{{$variant->slug}}">
                        @if($variant->price_basic != 0.00)
                          EUR {{ number_format($variant->price_basic, 2, ',', ' ') }}
                        @else
                          @lang('individual price')
                        @endif
                      </h2>
                      <h2 class="text-center fw-bold full-variant-price title full-{{$variant->slug}}">
                        @if($variant->price_full != 0.00)
                          EUR {{ number_format($variant->price_full, 2, ',', ' ') }}
                        @else
                          @lang('individual price')
                        @endif
                      </h2>
                    </div>
                    <div class="product-short-description">
                      <p>{!! $variant->{'description_'.app()->getLocale()} !!}</p>
                      <div class="product-details">
                        <div class="product-details-header d-flex justify-content-between">
                          @foreach($variant->productVariantAreaDetails as $productVariantAreaDetail)
                            <p>{{ $productVariantAreaDetail->{'name_'.app()->getLocale()} }}
                              : {{ $productVariantAreaDetail->square_meters }}
                              m<sup>2</sup></p>
                          @endforeach
                        </div>
                        @if($variant->productVariantDetails->count() > 0)
                          <hr class="m-1">
                          <ul class="product-details-content p-0 m-0">
                            @foreach($variant->productVariantDetails as $productVariantDetail)
                              @if($productVariantDetail->language === app()->getLocale())
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
                              @endif
                            @endforeach
                          </ul>
                          <hr class="m-1 mb-3">
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="d-flex flex-column align-items-center">
                    <button
                      class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
                      data-bs-toggle="modal" data-bs-target="#request-product-info">@lang('customer order')</button>
                  </div>
                </div>
                @if(count($variant->productVariantOptions) > 0)
                  <div class="tab-content product-variant-option mt-4">
                    <h3 class="fw-bold text-center my-2">@lang('tech specs')</h3>
                    <div class="tab-pane fade show active" id="basic-{{$variant->slug}}">
                      <div class="accordion accordion-flush">
                        @foreach($variant->productVariantOptions as $option)
                          @if($option->product_variant_id === $variant->id && $option->option_category === 'Basic' && $option->language === app()->getLocale())
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button collapsed variant-button" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#{{Str::slug($option->option_title)}}"
                                        aria-expanded="false" aria-controls="{{Str::slug($option->option_title)}}">
                                  {{ $option->option_title }}
                                </button>
                              </h2>
                              <div id="{{Str::slug($option->option_title)}}"
                                   class="accordion-collapse collapse product-variant-option-content">
                                <div class="accordion-body">
                                  {!! $option->options !!}
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                    </div>
                    <div class="tab-pane fade" id="full-{{$variant->slug}}">
                      <div class="accordion accordion-flush">
                        @foreach($variant->productVariantOptions as $option)
                          @if($option->product_variant_id === $variant->id && $option->option_category === 'Full' && $option->language === app()->getLocale())
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button collapsed variant-button" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#{{Str::slug($option->option_title)}}"
                                        aria-expanded="false" aria-controls="{{Str::slug($option->option_title)}}">
                                  {{ $option->option_title }}
                                </button>
                              </h2>
                              <div id="{{Str::slug($option->option_title)}}"
                                   class="accordion-collapse collapse product-variant-option-content">
                                <div class="accordion-body">
                                  {!! $option->options !!}
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
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
  <script>
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

    let isConsentToProcessData = false;
    let consentToProcessDataCheckbox = document.getElementById('customer-agrees-for-data-processing');
    const submitBtn = document.getElementById('submit-product-info-callback');
    consentToProcessDataCheckbox.checked = false;

    submitBtn.addEventListener('click', () => {
      submitBtn.classList.add('visually-hidden');
      document.getElementById('submit-product-info-callback-loading').classList.remove('visually-hidden');
    });

    consentToProcessDataCheckbox.addEventListener('change', (e) => {
      isConsentToProcessData = e.srcElement.checked;
      isConsentToProcessData ? submitBtn.classList.remove('disabled') : submitBtn.classList.add('disabled');
    });
  </script>
@endsection
