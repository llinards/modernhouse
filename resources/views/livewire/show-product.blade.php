<div>
  @include('includes.status-messages')
  @if(count($productVariants) !== 1)
    <ul class="nav nav-tabs d-flex border-0 buttons-content-switch justify-content-evenly">
      @foreach($productVariants as $index => $productsVariant)
        <li class="nav-item">
          <button
            class="nav-link d-inline-block {{ $productVariant->slug === $productsVariant->slug ? 'active' : '' }}"
            wire:click="switchProductVariant('{{$productsVariant->slug}}', {{$index}})"
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
  });
</script>
@endscript
