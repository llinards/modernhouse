<x-admin-layout>
  <x-slot name="header">
    <h2 class="text-center">Pievienot jaunu detaļu</h2>
  </x-slot>
  <x-slot name="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7 col-12">
          @include('includes.status-messages')
          <form action="/admin/product-variant/{{ $productVariant->id }}/product-variant-details"
                method="POST"
                enctype="multipart/form-data">
            @csrf
            <input name="product-variant-id" id="id" value="{{ $productVariant->id }}"
                   class="visually-hidden">
            <div class="mb-3">
              <label for="product-variant-detail-name" class="form-label">Nosaukums</label>
              <input type="text" class="form-control" id="product-variant-detail-name"
                     value="{{ old('product-variant-detail-name') }}"
                     name="product-variant-detail-name">
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       id="product-variant-detail-available"
                       name="product-variant-detail-available">
                <label class="form-check-label" for="product-variant-detail-available">
                  Pieejamība
                </label>
              </div>
            </div>
            <div class="mb-3">
              <label for="product-variant-detail-count" class="form-label">Skaits</label>
              <input type="number" class="form-control" id="product-variant-detail-count"
                     name="product-variant-detail-count">
            </div>
            <div class="mb-3">
              <p>Esošās ikonas</p>
              @foreach($allProductVariantDetailIcons as $productVariantDetailIcon)
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio"
                         value="{{$productVariantDetailIcon->name}}"
                         id="product-variant-detail-icon-{{$productVariantDetailIcon->id}}"
                         name="product-variant-detail-icon">
                  <label class="form-check-label"
                         for="product-variant-detail-icon-{{$productVariantDetailIcon->id}}">
                    <img
                      src="{{ asset('storage/icons/product-variant-detail-icons/'.$productVariantDetailIcon->name) }}"
                      alt="">
                  </label>
                </div>
              @endforeach
            </div>
            <div id="product-variant-detail-new-icon-upload" class="mb-3">
              <label for="product-variant-detail-new-icon" class="form-label">Pievieno jaunu
                ikonu</label>
              <input class="form-control" type="file" name="product-variant-detail-new-icon"
                     id="product-variant-detail-new-icon">
            </div>
            <div class="d-flex">
              <a href="/admin/product-variant/{{ $productVariant->id }}/product-variant-details"
                 class="btn btn-dark">Atpakaļ</a>
              <button type="submit" class="btn btn-success mx-1">Atjaunot</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </x-slot>
</x-admin-layout>
