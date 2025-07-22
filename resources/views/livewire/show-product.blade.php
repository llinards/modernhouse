<div>
  @include('includes.status-messages')
  @if(count($productVariants) !== 1)
    <ul class="nav nav-tabs d-flex border-0 justify-content-evenly buttons-content-switch mb-4" wire:ignore>
      @foreach($productVariants as $index => $productsVariant)
        <li class="nav-item product-variant-item" data-variant-index="{{ $index }}">
          <button
            class="nav-link d-inline-block {{ $productVariant->slug === $productsVariant->slug ? 'active' : '' }}"
            data-variant="{{$productsVariant->slug}}"
            wire:click="switchProductVariant('{{$productsVariant->slug}}')"
            wire:loading.attr="disabled"
            wire:target="switchProductVariant"
            type="button">{{ $productsVariant->translations[0]->name}}</button>
        </li>
      @endforeach
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
      document.querySelectorAll('.product-variant-item .nav-link').forEach(button => {
        button.classList.remove('active');
      });

      const activeButton = document.querySelector(`.product-variant-item button[data-variant="${variantSlug}"]`);
      if (activeButton) {
        activeButton.classList.add('active');
      }
    });

    // const activeVariantSlide = document.querySelector('.product-variant-item .nav-link.active');
    // if (activeVariantSlide) {
    //   const slideIndex = activeVariantSlide.closest('.product-variant-item').getAttribute('data-variant-index');
    //   if (slideIndex !== null) {
    //     swiper.slideTo(parseInt(slideIndex), 0);
    //   }
    // }
  });
</script>
@endscript
