<div>
  @include('includes.status-messages')
  @if(count($productVariants) !== 1)
    <ul class="nav nav-tabs d-flex border-0 buttons-content-switch swiper mb-4" wire:ignore>
      <div class="swiper-button-prev"></div>
      <div class="swiper-wrapper align-items-center">
        @foreach($productVariants as $index => $productsVariant)
          <li class="nav-item swiper-slide" data-variant-index="{{ $index }}">
            <button
              class="nav-link d-inline-block {{ $productVariant->slug === $productsVariant->slug ? 'active' : '' }}"
              data-variant="{{$productsVariant->slug}}"
              wire:click="switchProductVariant('{{$productsVariant->slug}}')"
              wire:loading.attr="disabled"
              wire:target="switchProductVariant"
              type="button">{{ $productsVariant->translations[0]->name}}</button>
          </li>
        @endforeach
      </div>
      <div class="swiper-button-next"></div>
    </ul>
  @endif
  <div class="position-relative">
    <x-loading-spinner target="switchProductVariant"/>
    @include('includes.request-product-info-modal', ['currentProductVariant' =>$productVariant, $product])
    <div class="row">
      <livewire:product.gallery :productVariant="$productVariant" :product="$product"
                                :key="'gallery-' . $productVariant->id"/>
      <livewire:product.details :productVariant="$productVariant" :product="$product"
                                :key="'details-' . $productVariant->id"/>
      @if($productVariant->productVariantOptions->isNotEmpty())
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
  </div>
</div>

@script
<script>
  document.addEventListener('livewire:initialized', () => {
    Livewire.on('update-url', params => {
      window.history.pushState({}, '', params.url);
    });

    Livewire.on('variantChanged', variantSlug => {
      document.querySelectorAll('.swiper-slide .nav-link').forEach(button => {
        button.classList.remove('active');
      });

      const activeButton = document.querySelector(`.swiper-slide button[data-variant="${variantSlug}"]`);
      if (activeButton) {
        activeButton.classList.add('active');
      }
    });

    const swiper = new Swiper('.swiper', {
      slidesPerView: 2,
      preventClicks: false,
      preventClicksPropagation: false,
      touchStartPreventDefault: false,
      breakpoints: {
        992: {slidesPerView: 5},
        570: {slidesPerView: 4},
      },
      on: {
        init: function () {
          const nextBtn = document.querySelector('.swiper-button-next');
          const prevBtn = document.querySelector('.swiper-button-prev');
          if (nextBtn) {
            nextBtn.addEventListener('click', () => {
              const activeSlide = document.querySelector('.swiper-slide .nav-link.active').closest('.swiper-slide');
              const activeIndex = parseInt(activeSlide.dataset.variantIndex);
              const nextSlide = document.querySelector(`.swiper-slide[data-variant-index="${activeIndex + 1}"]`);

              if (nextSlide) {
                nextSlide.querySelector('.nav-link').click();

                let slidesToShow;
                const windowWidth = window.innerWidth;

                if (windowWidth >= 992) {
                  slidesToShow = 5;
                } else if (windowWidth >= 570) {
                  slidesToShow = 4;
                } else {
                  slidesToShow = 2;
                }

                const slidePosition = activeIndex + 1;
                const currentVisibleEnd = Math.floor(swiper.activeIndex + slidesToShow - 1);

                if (slidePosition > currentVisibleEnd) {
                  swiper.slideTo(swiper.activeIndex + 1);
                }
              }
            });
          }

          if (prevBtn) {
            prevBtn.addEventListener('click', () => {
              const activeSlide = document.querySelector('.swiper-slide .nav-link.active').closest('.swiper-slide');
              const activeIndex = parseInt(activeSlide.dataset.variantIndex);
              const prevSlide = document.querySelector(`.swiper-slide[data-variant-index="${activeIndex - 1}"]`);

              if (prevSlide) {
                prevSlide.querySelector('.nav-link').click();

                let slidesToShow;
                const windowWidth = window.innerWidth;

                if (windowWidth >= 992) {
                  slidesToShow = 5;
                } else if (windowWidth >= 570) {
                  slidesToShow = 4;
                } else {
                  slidesToShow = 2;
                }

                const slidePosition = activeIndex - 1;

                if (slidePosition < swiper.activeIndex) {
                  swiper.slideTo(swiper.activeIndex - 1);
                }
              }
            });
          }
        }
      }
    });

    const activeVariantSlide = document.querySelector('.swiper-slide .nav-link.active');
    if (activeVariantSlide) {
      const slideIndex = activeVariantSlide.closest('.swiper-slide').getAttribute('data-variant-index');
      if (slideIndex !== null) {
        swiper.slideTo(parseInt(slideIndex), 0);
      }
    }
  });
</script>
@endscript
