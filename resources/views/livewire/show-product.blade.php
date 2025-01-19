<div>
  <x-slot name="header">
    {{ $product->translations[0]->name }}
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
            <h2 class="text-center">@lang('choose option')</h2>
            <x-product-variant-option-buttons :productVariant="$productVariant"/>
            <div class="mb-2">
              {{--              TODO: Nepieciešams būs rādīt katram produktu variantam atšķirīgus aprakstus--}}
              <div class="basic-variant-price basic-{{$productVariant->slug}} show active">
                <h3
                  class="text-center mt-3">
                  @if($productVariant->price_basic != 0.00)
                    @lang('price from') EUR {{ number_format($productVariant->price_basic, 2, ',', ' ') }}
                  @else
                    @lang('individual price')
                  @endif
                </h3>
                {{--                TODO: Temporary fix--}}
                @if(($product->slug === 'dvinu-majas' || $product->slug === 'privatmajas') && (app()->getLocale() === 'lv' || app()->getLocale() === 'en'))
                  <div class="mt-3 d-flex flex-column">
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('foundation_construction')</p>
                    </div>
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('utility_installation')</p>
                    </div>
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('house_structure_installation')</p>
                    </div>
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('external_finish_completed')</p>
                    </div>
                  </div>
                @endif
              </div>
              <div class="middle-variant-price middle-{{$productVariant->slug}}">
                <h3 class="text-center mt-3">
                  @if($productVariant->price_middle != 0.00)
                    @lang('price from') EUR {{ number_format($productVariant->price_middle, 2, ',', ' ') }}
                  @else
                    @lang('individual price')
                  @endif
                </h3>
                {{--                TODO: Temporary fix--}}
                @if(($product->slug === 'dvinu-majas' || $product->slug === 'privatmajas') && (app()->getLocale() === 'lv' || app()->getLocale() === 'en'))
                  <div class="mt-3 d-flex flex-column">
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('foundation_construction')</p>
                    </div>
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('internal_utility_installation')</p>
                    </div>
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('house_structure_installation')</p>
                    </div>
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('external_finish_with_panels')</p>
                    </div>
                  </div>
                @endif
              </div>
              <div class="full-variant-price full-{{$productVariant->slug}}">
                <h3 class="text-center mt-3">
                  @if($productVariant->price_full != 0.00)
                    @lang('price from') EUR {{ number_format($productVariant->price_full, 2, ',', ' ') }}
                  @else
                    @lang('individual price')
                  @endif
                </h3>
                {{--                TODO: Temporary fix--}}
                @if(($product->slug === 'dvinu-majas' || $product->slug === 'privatmajas') && (app()->getLocale() === 'lv' || app()->getLocale() === 'en'))
                  <div class="mt-3 d-flex flex-column">
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('foundation_construction')</p>
                    </div>
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('internal_utility_installation')</p>
                    </div>
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('house_structure_installation')</p>
                    </div>
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('complete_internal_and_external_finish')</p>
                    </div>
                    <div class="d-flex product-variant-options-included">
                      <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                      <p class="small">@lang('kitchen_and_bathroom_setup')</p>
                    </div>
                  </div>
                @endif
              </div>
            </div>
            <hr class="my-1">
            <div class="product-variant-description mx-auto">
              <p>{!! $productVariant->translations[0]->description !!}</p>
              <div class="d-flex justify-content-between">
                <p>@lang('living space') : {{ $productVariant->living_area }} m<sup>2</sup>
                </p>
                <p>@lang('construction area') : {{ $productVariant->building_area }}
                  m<sup>2</sup></p>
              </div>
              @if($productVariant->productVariantDetails->count() > 0)
                <hr class="my-1">
                <ul class="product-variant-details p-0 m-0">
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
                <hr class="my-1 mb-3">
              @endif
            </div>
          </div>
          <div class="d-flex flex-column align-items-center">
            <button id="{{$productVariant->slug}}"
                    class="btn btn-primary d-flex justify-content-center align-items-center request-product-info-modal"
            >@lang('customer order')</button>
          </div>
        </div>
        @if(count($productVariant->productVariantOptions) > 0)
          <h3 class="text-center mt-4 mb-1">@lang('tech specs')</h3>
          <x-product-variant-options :productVariant="$productVariant"/>
        @endif
        @if($productVariant->productVariantAttachments->isNotEmpty())
          @foreach($productVariant->productVariantAttachments as $attachment)
            <x-download-attachment
              :href="asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/'.$attachment->filename)"
              :filename="__('Download attachment')"/>
          @endforeach
        @endif
        @if(app()->getLocale() === 'lv' || app()->getLocale() === 'en')
          <h3 class="text-center mt-4 mb-1">@lang('faq')</h3>
          <x-faq/>
        @endif
      </div>
    @endif
    <script type="module">
      document.querySelectorAll('button[data-bs-toggle="tab"]').forEach((selectedVariant) => {
        selectedVariant.addEventListener('show.bs.tab', () => {
          const targetClass = selectedVariant.dataset.bsTarget;
          const currentVariantPrice = document.querySelector('.' + targetClass.replace('#', ''));
          if (currentVariantPrice) {
            document.querySelectorAll('.basic-variant-price, .middle-variant-price, .full-variant-price').forEach((element) => {
              element.classList.remove('show', 'active');
            });
            currentVariantPrice.classList.add('show', 'active');
          }
        });
      });

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

