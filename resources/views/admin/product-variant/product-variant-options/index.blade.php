<x-layouts.admin>
  <x-slot name="header">
    Tehniskā informācija
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-12">
        @include('includes.status-messages')
        <form action="{{ route('product-variant-options.import', ['productVariant' => $productVariant->id]) }}"
              method="POST">
          @csrf
          <input name="product-variant-id" id="id" value="{{$productVariant->id}}"
                 class="visually-hidden">
          <x-file-upload :required="true"
                         :name="'product-variant-options-excel'"/>
          <button type="submit" class="btn btn-success">Augšupielādēt</button>
        </form>
      </div>
    </div>
    <div class="row justify-content-center mt-5">
      @if(count($productVariant->productVariantOptions) === 0)
        <div class="col-lg-7 col-12">
          <div class="alert alert-secondary" role="alert">
            Izskatās, ka pagaidām tehniskā informācija nav pievienota.
          </div>
        </div>
      @else
        <div class="col-12">
          <livewire:admin.product-variant-option-detail-list :productVariant="$productVariant"/>
          <div class="d-flex justify-content-center">
            <form
              action="{{route('product-variant-options.destroy', ['productVariant' => $productVariant->id])}}"
              method="POST">
              @csrf
              @method('DELETE')
              <button onclick="return confirm('Vai tiešām vēlies dzēst ierakstu visu tehnisko informāciju?');"
                      class="btn btn-danger"
                      type="submit">
                Dzēst visu tehnisko informāciju
              </button>
            </form>
          </div>
        </div>
      @endif
    </div>
  </x-slot>
</x-layouts.admin>
