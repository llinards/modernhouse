@extends('app', ['title' => $product->name, 'index' => false, 'allProducts' => $allProducts])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">{{ $product->{'name_'.app()->getLocale()} }}</h1>
      @include('includes.status-messages')
      <div>
        <ul class="nav mt-4 nav-tabs d-flex product-variant-titles">
          @if(count($product->productVariants) !== 1)
            @foreach($product->productVariants as $variant)
              @if($variant->is_active)
                <li class="nav-item">
                  <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                          data-bs-target="#{{Str::slug($variant->name)}}" type="button">{{ $variant->name }}</button>
                </li>
              @endif
            @endforeach
          @endif
        </ul>
        <div class="tab-content">
          @foreach($product->productVariants as $variant)
            @if($variant->is_active)
              <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{Str::slug($variant->name)}}">
                <div class="row">
                  <div class="col-lg-7 mt-4">
                    <section id="{{Str::slug($variant->name)}}-main-carousel" class="splide">
                      <div class="splide__track">
                        <ul class="splide__list">
                          @foreach($product->productVariantImages as $image)
                            @if($image->product_variant_id === $variant->id)
                              <li class="splide__slide">
                                <img class="img-fluid"
                                     data-splide-lazy="{{ asset('storage/product-images/'.Str::slug($product->slug)).'/'.Str::slug($variant->name).'/'.$image->filename }}"
                                     alt="{{ $variant->name }}">
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
                                <img class="img-fluid"
                                     data-splide-lazy="{{ asset('storage/product-images/'.Str::slug($product->slug)).'/'.Str::slug($variant->name).'/'.$image->filename }}"
                                     alt="{{ $variant->name }}"/>
                              </li>
                            @endif
                          @endforeach
                        </ul>
                      </div>
                    </section>
                  </div>
                  <div class="col-lg-5 mt-4 d-flex flex-column justify-content-between">
                    <div>
                      <h2 class="fw-bold text-center title">Izvēlies komplektāciju</h2>
                      <ul class="nav nav-tabs d-flex product-variant-option-titles flex-nowrap">
                        <li class="nav-item">
                          <button class="nav-link active basic-variant-title" data-bs-toggle="tab"
                                  data-bs-target="#basic-{{Str::slug($variant->name)}}" type="button">Rūpnīcas
                          </button>
                        </li>
                        <li class="nav-item">
                          <button class="nav-link full-variant-title" data-bs-toggle="tab"
                                  data-bs-target="#full-{{Str::slug($variant->name)}}" type="button">Pilna
                          </button>
                        </li>
                      </ul>
                      <div class="mt-4 mb-2">
                        <h2
                          class="text-center fw-bold basic-variant-price title show active basic-{{Str::slug($variant->name)}}">
                          @if($variant->price_basic != 0.00)
                            EUR {{ number_format($variant->price_basic, 2, ',', ' ') }}
                          @else
                            Cena pēc individuāla pieprasījuma
                          @endif
                        </h2>
                        <h2 class="text-center fw-bold full-variant-price title full-{{Str::slug($variant->name)}}">
                          @if($variant->price_basic != 0.00)
                            EUR {{ number_format($variant->price_full, 2, ',', ' ') }}
                          @else
                            Cena pēc individuāla pieprasījuma
                          @endif
                        </h2>
                      </div>
                      <div class="product-short-description">
                        <p>{!! $variant->description !!}</p>
                        <div class="product-details">
                          <div class="product-details-header d-flex justify-content-between">
                            @foreach($variant->productVariantAreaDetails as $productVariantAreaDetail)
                              <p>{{ $productVariantAreaDetail->name }}: {{ $productVariantAreaDetail->square_meters }}
                                m<sup>2</sup></p>
                            @endforeach
                          </div>
                          <hr class="m-1">
                          <ul class="product-details-content p-0 m-0">
                            @foreach($variant->productVariantDetails as $productVariantDetail)
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
                        </div>
                      </div>
                    </div>
                    <div class="d-flex flex-column align-items-center">
                      <button
                        class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
                        data-bs-toggle="modal" data-bs-target="#request-product-info">@lang('customer order')</button>
                    </div>
                  </div>
                  @if(count($product->productVariantOptions) > 0)
                    <div class="tab-content product-variant-option mt-4">
                      <h3 class="fw-bold text-center my-2">Tehniskās specifikācijas</h3>
                      <div class="tab-pane fade show active" id="basic-{{Str::slug($variant->name)}}">
                        <div class="accordion accordion-flush">
                          @foreach($product->productVariantOptions as $option)
                            @if($option->product_variant_id === $variant->id && $option->option_category === 'Basic')
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
                      <div class="tab-pane fade" id="full-{{Str::slug($variant->name)}}">
                        <div class="accordion accordion-flush">
                          @foreach($product->productVariantOptions as $option)
                            @if($option->product_variant_id === $variant->id && $option->option_category === 'Full')
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
            @endif
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
    consentToProcessDataCheckbox.checked = false;

    consentToProcessDataCheckbox.addEventListener('change', (e) => {
      isConsentToProcessData = e.srcElement.checked;
      isConsentToProcessData ? document.getElementById('submit-product-info-callback').classList.remove('disabled') : document.getElementById('submit-product-info-callback').classList.add('disabled');
    });
  </script>
@endsection
