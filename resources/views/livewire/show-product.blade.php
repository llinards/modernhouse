<div>
  @include('includes.status-messages')
  @if(count($productVariants) !== 1)
    <ul class="nav nav-tabs d-flex border-0 buttons-content-switch justify-content-between">
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
    <div class="product-content">
      <p>
        {{ $productVariant->translations[0]->name }}
      </p>
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
