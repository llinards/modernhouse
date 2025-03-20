<div>
  @include('includes.status-messages')
  @if($product->cover_video_filename)
    <video class="h-100 w-100" playsinline autoplay muted loop
           poster="{{asset('storage/product-images/'.$product->slug.'/'.$product->cover_photo_filename)}}">
      <source src="{{asset('storage/product-images/'.$product->slug.'/'.$product->cover_video_filename)}}"
              type="video/mp4">
    </video>
  @endif
  @if(count($productVariants) !== 1)
    <ul class="nav nav-tabs d-flex border-0 buttons-content-switch swiper my-2" wire:ignore>
      <div class="swiper-button-prev"></div>
      <div class="swiper-wrapper align-items-center">
        @foreach($productVariants as $index => $productsVariant)
          <li class="nav-item swiper-slide">
            <button
              class="nav-link d-inline-block {{ $productVariant->slug === $productsVariant->slug ? 'active' : '' }}"
              data-variant="{{$productsVariant->slug}}"
              wire:click="switchProductVariant('{{$productsVariant->slug}}', {{$index}})"
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
      modules: [Navigation],
      slidesPerView: 2,
      preventClicks: false,
      preventClicksPropagation: false,
      touchStartPreventDefault: false,
      breakpoints: {
        992: {slidesPerView: 5},
        570: {slidesPerView: 4},
        // 425: {slidesPerView: 3}
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }
    });
  });
</script>
@endscript
