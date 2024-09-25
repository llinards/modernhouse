<x-layouts.admin>
  <x-slot name="header">
    Rediģēt
    - {{ $productVariant->translations[0]->name ?? 'Nav pievienots tulkojums!' }}
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-12">
        @include('includes.status-messages')
        <form action="/admin/product-variant" id="update-product-variant" method="POST"
              enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <input name="id" id="id" value="{{ $productVariant->id }}" class="visually-hidden">
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox"
                     value="{{ $productVariant->is_active }}"
                     id="product-variant-available"
                     name="product-variant-available" {{ $productVariant->is_active ? 'checked' : '' }} >
              <label class="form-check-label" for="product-variant-available">
                Pieejams mājaslapā
              </label>
            </div>
          </div>
          <div class="mb-3">
            <label for="product-variant-name" class="form-label">Nosaukums</label>
            <input type="text" class="form-control" id="product-variant-name"
                   value="{{ $productVariant->translations[0]->name ?? 'Nav pievienots tulkojums!' }}"
                   name="product-variant-name">
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-4">
                <label for="product-variant-basic-price" class="form-label">Cena bāzes
                  komplektācijai</label>
                <input type="text" name="product-variant-basic-price"
                       id="product-variant-basic-price"
                       value="{{ $productVariant->price_basic }}" class="form-control">
              </div>
              <div class="col-4">
                <label for="product-variant-middle-price" class="form-label">Cena pelēkai apdarei</label>
                <input type="text" name="product-variant-middle-price"
                       id="product-variant-middle-price"
                       value="{{ $productVariant->price_middle }}" class="form-control">
              </div>
              <div class="col-4">
                <label for="product-variant-full-price" class="form-label">Cena pilnai
                  komplektācijai</label>
                <input type="text" name="product-variant-full-price"
                       id="product-variant-full-price"
                       value="{{ $productVariant->price_full }}" class="form-control">
              </div>
              <p class="small">Ja cena tiek norādīta kā 0.00, tad klientiem rādīsies -
                <strong>Cena pēc
                  individuālā pieprasījuma.</strong></p>
            </div>
          </div>
          <div class="mb-3">
            <a href="/admin/product-variant/{{ $productVariant->id }}/product-variant-options"
               class="btn btn-dark" target="_blank">Tehniskā informācija</a>
            <a href="/admin/product-variant/{{ $productVariant->id }}/product-variant-details"
               class="btn btn-dark" target="_blank">Platība, istabas</a>
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-6">
                <label for="product-variant-living-area" class="form-label">Iekštelpu
                  platība</label>
                <input type="text" name="product-variant-living-area"
                       value="{{ $productVariant->living_area }}" class="form-control">
              </div>
              <div class="col-6">
                <label for="product-variant-building-area" class="form-label">Apbūves
                  laukums</label>
                <input type="text" name="product-variant-building-area"
                       value="{{ $productVariant->building_area }}" class="form-control">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="product-variant-description" class="form-label">Apraksts</label>
            <x-description-text-area
              :name="'product-variant-description'">{{ $productVariant->translations[0]->description ?? 'Nav pievienots tulkojums!' }}</x-description-text-area>
          </div>
          <livewire:admin.product-variant-image-list :product="$product" :productVariant="$productVariant"/>
          <div class="mb-3">
            <label for="product-variant-images" class="form-label">Pievienot jaunas
              bildes</label>
            <x-file-upload :name="'product-variant-images'"/>
            <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā
              izmērā.</p>
            <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/"
                                                              target="_blank">compressor.io</a>
            </p>
          </div>
          <div class="mb-3">
            <label for="product-variant-attachments" class="form-label">Pielikums</label>
            <x-file-upload :name="'product-variant-attachments'"/>
            <p class="small">Pievienojot jaunu pielikumu, ja eksistē iepriekšējais, tas tiks aizvietots.</p>
            <p class="small">Maksimālais faila izmērs 50 MB un jābūt PDF.</p>
          </div>
          <div class="d-flex justify-content-between">
            <button type="button" data-bs-toggle="modal"
                    data-bs-target="#delete-product-variant-modal"
                    class="btn btn-danger">Dzēst
            </button>
            <div class="d-flex">
              <a href="/admin" class="btn btn-dark">Atpakaļ</a>
              <button type="submit" form="update-product-variant"
                      class="btn btn-success mx-1">Atjaunot
              </button>
            </div>
          </div>
        </form>
        @include('admin.product-variant.delete-modal')
      </div>
    </div>
  </x-slot>
</x-layouts.admin>

