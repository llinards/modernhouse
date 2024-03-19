<div>
  <x-slot name="header">
    <h1 class="text-center text-uppercase title">{{ $product->translations[0]->name }}</h1>
  </x-slot>
  <x-slot name="content">
    @include('includes.status-messages')
    <ul class="nav nav-tabs d-flex justify-content-evenly border-0 buttons-content-switch">
      @if(count($productVariants) !== 1)
        @foreach($productVariants as $productsVariant)
          <li class="nav-item">
            <a class="nav-link {{ $productVariant->slug === $productsVariant->slug ? 'active' : '' }}"
               wire:navigate.hover
               href="/{{app()->getLocale()}}/{{$product->slug}}/{{$productsVariant->slug}}"
               type="button">{{ $productsVariant->translations[0]->name}}</a>
          </li>
        @endforeach
      @endif
    </ul>
    @if($productVariant)
      @include('includes.request-product-info-modal', ['currentProductVariant' =>$productVariant, $product])
      <div class="row">
        <div id="product-variant-gallery" class="col-lg-7 mt-4">
          <section id="{{$productVariant->slug}}-main-carousel" class="splide">
            <div class="splide__track">
              <ul class="splide__list">
                @foreach($productVariant->productVariantImages as $image)
                  <li class="splide__slide">
                    <a data-fslightbox="{{$productVariant->slug}}"
                       href="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/'.$image->filename) }}">
                      <img class="img-fluid"
                           data-splide-lazy="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/'.$image->filename) }}"
                           alt="{{ $productVariant->{'name_'.app()->getLocale()} }}">
                    </a>
                  </li>
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
            <button id="{{$productVariant->slug}}"
                    class="btn btn-primary fw-light d-flex justify-content-center align-items-center request-product-info-modal"
            >@lang('customer order')</button>
          </div>
        </div>
        @if(count($productVariant->productVariantOptions) > 0)
          <h3 class="fw-bold text-center mt-4 mb-1">@lang('tech specs')</h3>
          <x-product-variant-options :productVariant="$productVariant"/>
        @endif
        @if(app()->getLocale() === 'lv')
          <h3 class="fw-bold text-center mt-4 mb-1">Biežāk uzdotie jautājumi</h3>
          <x-faq/>
        @endif
      </div>
    @endif
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

      const gallery = document.getElementById('product-variant-gallery');
      const main = new Splide('#' + gallery.firstElementChild.id, {
        type: 'fade',
        pagination: false,
        lazyLoad: 'sequential',
        rewind: true,
      });
      const thumbnails = new Splide('#' + gallery.lastElementChild.id, {
        fixedWidth: 100,
        fixedHeight: 60,
        gap: 10,
        arrows: false,
        pagination: false,
        isNavigation: true,
        lazyLoad: 'sequential',
        breakpoints: {
          600: {
            fixedWidth: 60,
            fixedHeight: 44,
          },
        },
      });
      main.sync(thumbnails);
      main.mount();
      thumbnails.mount();

      refreshFsLightbox();

      const requestProductInfoModal = new bootstrap.Modal('#request-product-info');
      const requestProductInfoButtons = document.querySelectorAll('.request-product-info-modal');
      requestProductInfoButtons.forEach((requestProductInfoButton) => {
        requestProductInfoButton.addEventListener('click', () => {
          requestProductInfoModal.show();
        })
      })
    </script>
  </x-slot>
</div>

