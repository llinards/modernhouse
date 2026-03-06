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
              wire:loading.class="pe-none"
              wire:target="switchProductVariant"
              type="button">{{ $tab['name'] }}</button>
          </li>
        @endforeach
      </div>
      <div class="swiper-button-next"></div>
    </ul>
  @endif
  <div class="position-relative"
       wire:loading.class="opacity-50"
       wire:target="switchProductVariant"
       style="transition: opacity 0.2s">
    <x-loading-spinner target="switchProductVariant"/>
    @include('includes.request-product-info-modal', ['currentProductVariant' => $this->selectedVariant, 'product' => $this->product])
    <div class="row">
      <x-product.gallery :productVariant="$this->selectedVariant" :product="$this->product"/>
      <x-product.details :productVariant="$this->selectedVariant" :product="$this->product"/>
      @if($this->selectedVariant->productVariantOptions->isNotEmpty())
        <h3 class="text-center mt-4 mb-1">@lang('tech specs')</h3>
        <x-product-variant-options :productVariant="$this->selectedVariant"/>
      @endif
      @if($this->selectedVariant->productVariantAttachments->isNotEmpty())
        @foreach($this->selectedVariant->productVariantAttachments as $attachment)
          <x-download-attachment
            :href="asset('storage/product-images/'.$this->product->slug.'/'.$this->selectedVariant->slug.'/'.$attachment->filename)"
            :filename="__('Download attachment')"/>
        @endforeach
      @endif
    </div>
  </div>
  <h3 class="text-center mt-4 mb-1">@lang('faq')</h3>
  <x-faq/>
</div>

@script
<script>
  document.addEventListener('livewire:initialized', () => {
    function initGallery() {
      const gallery = document.getElementById('product-variant-gallery');
      if (!gallery) return;

      const isDesktop = window.innerWidth >= 992;
      const mainOptions = {
        type: 'fade',
        pagination: false,
        lazyLoad: 'sequential',
        rewind: true,
      };

      if (isDesktop) {
        const detailsCol = gallery.nextElementSibling;
        const thumbnailEl = gallery.lastElementChild;
        const thumbnailHeight = thumbnailEl ? thumbnailEl.offsetHeight + 8 : 68;
        const detailsHeight = detailsCol ? detailsCol.offsetHeight : 0;
        mainOptions.fixedHeight = detailsHeight > thumbnailHeight ? detailsHeight - thumbnailHeight : 500;
      } else {
        mainOptions.fixedHeight = 500;
        mainOptions.breakpoints = { 768: { fixedHeight: 400 } };
      }

      const main = new Splide('#' + gallery.firstElementChild.id, mainOptions);
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

      Fancybox.bind("[data-fancybox]", {});
    }

    function initDetails() {
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

      const modal = new bootstrap.Modal('#request-product-info');
      document.querySelectorAll('.request-product-info-modal').forEach(button => {
        button.addEventListener('click', () => modal.show());
      });
    }

    // Initialize on first load
    initGallery();
    initDetails();

    // Swiper (variant tabs) - only initialized once, wrapped in wire:ignore
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

      // Re-initialize gallery and details after Livewire re-renders the DOM
      setTimeout(() => {
        initGallery();
        initDetails();
      }, 0);
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
