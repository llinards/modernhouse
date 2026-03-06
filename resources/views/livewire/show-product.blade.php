<div>
  @include('includes.status-messages')
  @if(count($variantTabs) !== 1)
    <ul class="nav nav-tabs d-flex border-0 buttons-content-switch swiper mb-4" wire:ignore>
      <div class="swiper-button-prev"></div>
      <div class="swiper-wrapper">
        @foreach($variantTabs as $index => $tab)
          <li class="nav-item swiper-slide" data-variant-index="{{ $index }}">
            <button
              class="nav-link {{ $productVariantSlug === $tab['slug'] ? 'active' : '' }}"
              data-variant="{{ $tab['slug'] }}"
              wire:click="switchProductVariant('{{ $tab['slug'] }}')"
              wire:loading.attr="disabled"
              wire:target="switchProductVariant"
              type="button">{{ $tab['name'] }}</button>
          </li>
        @endforeach
      </div>
      <div class="swiper-button-next"></div>
    </ul>
  @endif
  <div class="position-relative">
    <x-loading-spinner target="switchProductVariant"/>
    @include('includes.request-product-info-modal', ['currentProductVariant' =>$selectedVariant, $product])
    <div class="row">
      <livewire:product.gallery :productVariant="$selectedVariant" :product="$product"
                                :key="'gallery-' . $selectedVariant->id"/>
      <livewire:product.details :productVariant="$selectedVariant" :product="$product"
                                :key="'details-' . $selectedVariant->id"/>
      @if($selectedVariant->productVariantOptions->isNotEmpty())
        <h3 class="text-center mt-4 mb-1">@lang('tech specs')</h3>
        <x-product-variant-options :productVariant="$selectedVariant"/>
      @endif
      @if($selectedVariant->productVariantAttachments->isNotEmpty())
        @foreach($selectedVariant->productVariantAttachments as $attachment)
          <x-download-attachment
            :href="asset('storage/product-images/'.$product->slug.'/'.$selectedVariant->slug.'/'.$attachment->filename)"
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
    const nextBtn = document.querySelector('.swiper-button-next');
    const prevBtn = document.querySelector('.swiper-button-prev');
    const totalSlides = document.querySelectorAll('.swiper-slide').length;

    function updateArrowState(activeIndex) {
      prevBtn?.classList.toggle('disabled', activeIndex <= 0);
      nextBtn?.classList.toggle('disabled', activeIndex >= totalSlides - 1);
    }

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
        const slideIndex = parseInt(activeButton.closest('.swiper-slide').dataset.variantIndex);
        updateArrowState(slideIndex);
      }
    });

    const swiper = new Swiper('.swiper', {
      slidesPerView: 2,
      preventClicks: false,
      preventClicksPropagation: false,
      touchStartPreventDefault: false,
      breakpoints: {
        570: {slidesPerView: 4},
        992: {slidesPerView: 5},
      },
    });

    function switchVariant(direction) {
      const activeSlide = document.querySelector('.swiper-slide .nav-link.active')?.closest('.swiper-slide');
      if (!activeSlide) return;
      const targetIndex = parseInt(activeSlide.dataset.variantIndex) + direction;
      const targetSlide = document.querySelector(`.swiper-slide[data-variant-index="${targetIndex}"]`);
      if (targetSlide) {
        targetSlide.querySelector('.nav-link').click();
        updateArrowState(targetIndex);
        if (targetIndex < swiper.activeIndex || targetIndex >= swiper.activeIndex + swiper.params.slidesPerView) {
          swiper.slideTo(targetIndex);
        }
      }
    }

    nextBtn?.addEventListener('click', () => switchVariant(1));
    prevBtn?.addEventListener('click', () => switchVariant(-1));

    const activeVariantSlide = document.querySelector('.swiper-slide .nav-link.active');
    if (activeVariantSlide) {
      const slideIndex = parseInt(activeVariantSlide.closest('.swiper-slide').dataset.variantIndex);
      updateArrowState(slideIndex);
      swiper.slideTo(slideIndex, 0);
    }
  });
</script>
@endscript
