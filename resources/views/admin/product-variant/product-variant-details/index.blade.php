<x-layouts.admin>
  <x-slot name="header">
    Detaļas
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-12">
        <div class="mb-5 text-center">
          <a class="btn btn-success"
             href="/admin/product-variant/{{ $productVariant->id }}/product-variant-details/create">+</a>
        </div>
        @include('includes.status-messages')
        <div class="row">
          @foreach($productVariantDetails as $productVariantDetail)
            <div class="col-6 text-center">
              <div class="mb-3">
                <h5>{{ $productVariantDetail->name }}</h5>
                <img width="25"
                     src="{{ $productVariantDetail->hasThis ? asset('storage/icons/check.svg') : asset('storage/icons/negative.svg') }}"/>
                <img width="25"
                     src="{{ asset('storage/icons/product-variant-detail-icons/'.$productVariantDetail->icon.'.svg') }}"
                     alt="">
                <p>Skaits: {{ $productVariantDetail->count }}</p>
                <a
                  href="{{ URL::to('/admin/product-variant/'.$productVariant->id.'/product-variant-details/'.$productVariantDetail->id) }}"
                  class="btn btn-danger mt-2">Dzēst</a>
              </div>
            </div>
          @endforeach
        </div>
        <div class="d-flex">
          <a href="/admin/product-variant/{{ $productVariant->id }}/edit" class="btn btn-dark">Atpakaļ</a>
        </div>
      </div>
    </div>
  </x-slot>
</x-layouts.admin>
