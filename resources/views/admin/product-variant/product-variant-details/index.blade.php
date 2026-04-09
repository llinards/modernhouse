<x-layouts.admin>
  <x-slot name="header">
    Platība, istabas
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-center">
      <div class="col-12">
        <livewire:admin.product-variant-detail-list :productVariant="$productVariant"/>
      </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
      <a href="/admin/{{ app()->getLocale() }}/product-variant/{{ $productVariant->id }}/edit"
         class="btn btn-dark">Atpakaļ</a>
    </div>
  </x-slot>
</x-layouts.admin>
