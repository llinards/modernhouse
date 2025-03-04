<div>
  <x-slot name="header">
    {{ $product->translations[0]->name }}
  </x-slot>
  <x-slot name="content">
    @include('includes.status-messages')
    <ul class="nav nav-tabs d-flex justify-content-evenly border-0 buttons-content-switch swiper">
      @if(count($productVariants) !== 1)
        <div class="swiper-wrapper">
          @foreach($productVariants as $productsVariant)
            <li class="nav-item swiper-slide" data-swiper-slide-index="{{ $loop->index }}">
              <a class="nav-link d-inline-block {{ $productVariant->slug === $productsVariant->slug ? 'active' : '' }}"
                 wire:navigate.hover
                 href="/{{app()->getLocale()}}/{{$product->slug}}/{{$productsVariant->slug}}"
                 type="button">
                {{ $productsVariant->translations[0]->name}}
              </a>
            </li>
          @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
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
                    <a data-fancybox="{{$productVariant->slug}}"
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
              @if($productVariant->price_basic)
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
                  @if(($product->slug === 'twin-houses' || $product->slug === 'timberframe-houses'))
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
              @endif
              @if($productVariant->price_middle)
                <div class="middle-variant-price middle-{{$productVariant->slug}}">
                  <h3 class="text-center mt-3">
                    @if($productVariant->price_middle != 0.00)
                      @lang('price from') EUR {{ number_format($productVariant->price_middle, 2, ',', ' ') }}
                    @else
                      @lang('individual price')
                    @endif
                  </h3>
                  {{--                TODO: Temporary fix--}}
                  @if(($product->slug === 'twin-houses' || $product->slug === 'timberframe-houses'))
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
              @endif
              @if($productVariant->price_full)
                <div class="full-variant-price full-{{$productVariant->slug}}">
                  <h3 class="text-center mt-3">
                    @if($productVariant->price_full != 0.00)
                      @lang('price from') EUR {{ number_format($productVariant->price_full, 2, ',', ' ') }}
                    @else
                      @lang('individual price')
                    @endif
                  </h3>
                  {{--                TODO: Temporary fix--}}
                  @if(($product->slug === 'twin-houses' || $product->slug === 'timberframe-houses'))
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
              @endif
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
                <hr class="my-1 mb-4">
              @endif
            </div>
          </div>
          <div class="d-flex flex flex-wrap gap-2 justify-content-center">
            @if($productVariant->productVariantPlan->isNotEmpty())
              @foreach($productVariant->productVariantPlan as $plan)
                <a
                  class="btn btn-primary btn-primary-sm d-flex justify-content-center align-items-center {{$loop->first ? '' : 'visually-hidden'}}"
                  href="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/plan/'.$plan->filename) }}"
                  data-fancybox="{{$productVariant->slug}}-plan">
                  @lang('View the house plan')
                </a>
              @endforeach
            @endif
            <button id="{{$productVariant->slug}}"
                    class="btn btn-primary btn-primary-sm d-flex justify-content-center align-items-center request-product-info-modal"
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
        <h3 class="text-center mt-4 mb-1">@lang('faq')</h3>
        <x-faq/>
      </div>
    @endif
    <script type="module">
      document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(button => {
        button.addEventListener('show.bs.tab', () => {
          const targetClass = button.dataset.bsTarget.replace('#', '');
          const currentVariantPrice = document.querySelector(`.${targetClass}`);
          if (currentVariantPrice) {
            document.querySelectorAll('.basic-variant-price, .middle-variant-price, .full-variant-price')
              .forEach(element => element.classList.remove('show', 'active'));
            currentVariantPrice.classList.add('show', 'active');
          }
        });
      });

      const gallery = document.getElementById('product-variant-gallery');

      const main = new Splide(`#${gallery.firstElementChild.id}`, {
        type: 'fade',
        pagination: false,
        lazyLoad: 'sequential',
        rewind: true,
        autoplay: true,
        interval: 3000,
        pauseOnHover: true,
        pauseOnFocus: true,
        drag: true,
        breakpoints: {
          992: {
            heightRatio: 0.5,
          },
        }
      });

      const thumbnails = new Splide(`#${gallery.lastElementChild.id}`, {
        fixedWidth: 100,
        fixedHeight: 60,
        gap: 10,
        arrows: false,
        pagination: false,
        isNavigation: true,
        lazyLoad: 'sequential',
        keyboard: true,
        drag: true,
        breakpoints: {
          600: {
            fixedWidth: 60,
            fixedHeight: 44,
          },
        },
      });

      main.sync(thumbnails).mount();
      thumbnails.mount();

      Fancybox.bind("[data-fancybox]", {});

      document.addEventListener('livewire:navigated', () => {
        const swiperContainer = document.querySelector('.swiper');
        if (!swiperContainer) return;

        const activeSlide = document.querySelector('.nav-link.active')?.closest('.swiper-slide');
        if (!activeSlide) return;

        const activeIndex = parseInt(activeSlide.dataset.swiperSlideIndex) || 0;

        const swiper = new Swiper('.swiper', {
          modules: [Navigation],
          slidesPerView: 2,
          preventClicks: false,
          preventClicksPropagation: false,
          touchStartPreventDefault: false,
          initialSlide: activeIndex,
          slideToClickedSlide: true,
          breakpoints: {
            992: {
              slidesPerView: 5,
            },
            768: {
              slidesPerView: 4,
            },
            425: {
              slidesPerView: 3,
            }
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          on: {
            init: function () {
              const currentSlidesPerView = this.params.slidesPerView;
              const pageIndex = Math.floor(activeIndex / currentSlidesPerView);
              this.slideTo(pageIndex * currentSlidesPerView, 0, false);
            },
            resize: function () {
              const currentSlidesPerView = this.params.slidesPerView;
              const pageIndex = Math.floor(activeIndex / currentSlidesPerView);
              this.slideTo(pageIndex * currentSlidesPerView, 0, false);
            }
          }
        });
        window.productVariantsSwiper = swiper;
      });

      const modal = new bootstrap.Modal('#request-product-info');
      document.querySelectorAll('.request-product-info-modal').forEach(button => {
        button.addEventListener('click', () => modal.show());
      });
    </script>
  </x-slot>
</div>

