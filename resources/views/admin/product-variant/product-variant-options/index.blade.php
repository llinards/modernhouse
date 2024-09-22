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
          <input name="product-variant-id" id="id" value="13"
                 class="visually-hidden">
          <x-file-upload
            :name="'product-variant-options-excel'"/>
          <button type="submit">Upload</button>
        </form>
      </div>
    </div>
  </x-slot>
</x-layouts.admin>
