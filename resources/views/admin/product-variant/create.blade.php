<x-admin-layout>
  <x-slot name="header">
    Pievienot jaunu moduli/māju
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-12">
        @include('includes.status-messages')
        <form action="/admin/product-variant" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="product-id" class="form-label">Izvēlies kategoriju</label>
            <select class="form-select" name="product-id" id="product-id">
              <option selected>Izvēlies...</option>
              @foreach($products as $product)
                <option
                  value="{{ $product->id }}">{{ $product->translations[0]->name ?? 'Nav pievienots tulkojums!' }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="product-variant-name" class="form-label">Nosaukums</label>
            <input type="text" class="form-control" id="product-variant-name"
                   value="{{ old('product-variant-name') }}" name="product-variant-name">
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-6">
                <label for="product-variant-basic-price" class="form-label">Cena rūpnīcas
                  komplektācijai</label>
                <input type="text" name="product-variant-basic-price"
                       id="product-variant-basic-price"
                       value="{{ old('product-variant-basic-price') }}"
                       class="form-control">
              </div>
              <div class="col-6">
                <label for="product-variant-full-price" class="form-label">Cena pilnai
                  komplektācijai</label>
                <input type="text" name="product-variant-full-price"
                       id="product-variant-full-price"
                       value="{{ old('product-variant-full-price') }}" class="form-control">
              </div>
              <p class="small">Ja cena tiek norādīta kā 0.00, tad klientiem rādīsies -
                <strong>Cena pēc
                  individuālā pieprasījuma.</strong></p>
            </div>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-6">
                <label for="product-variant-living-area" class="form-label">Dzīvojamā
                  platība</label>
                <input type="text" name="product-variant-living-area"
                       value="{{ old('product-variant-living-area') }}"
                       class="form-control">
              </div>
              <div class="col-6">
                <label for="product-variant-building-area" class="form-label">Apbūves
                  platība</label>
                <input type="text" name="product-variant-building-area"
                       value="{{ old('product-variant-building-area') }}"
                       class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="product-variant-description" class="form-label">Apraksts</label>
            <x-description-text-area
              :name="'product-variant-description'">{{ old('product-variant-description') }}</x-description-text-area>
          </div>
          <div class="mb-3">
            <label for="product-variant-images" class="form-label">Bildes</label>
            <x-file-upload :name="'product-variant-images'" :required="'true'"/>
            <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā
              izmērā.</p>
            <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/"
                                                              target="_blank">compressor.io</a>
            </p>
          </div>
          <a href="/admin" class="btn btn-dark">Atpakaļ</a>
          <button type="submit" class="btn btn-success">Pievienot</button>
        </form>
      </div>
    </div>
  </x-slot>
</x-admin-layout>
