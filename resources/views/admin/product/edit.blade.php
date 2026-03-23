<x-layouts.admin>
  <x-slot name="header">
    Rediģēt
    - {{ $product->translations[0]->name ?? 'Nav pievienots tulkojums!' }}
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-12">
        @include('includes.status-messages')
        <form action="{{ route('admin.products.update', ['locale' => app()->getLocale(), 'product' => $product]) }}"
              method="POST" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox"
                     value="{{ $product->is_active }}"
                     id="product-available"
                     name="product-available" {{ $product->is_active ? 'checked' : '' }} >
              <label class="form-check-label" for="product-available">
                Pieejams mājaslapā
              </label>
            </div>
          </div>
          <div class="mb-3">
            <label for="product-name" class="form-label">Nosaukums</label>
            <input type="text" class="form-control" id="product-name"
                   value="{{ $product->translations[0]->name ?? 'Nav pievienots tulkojums!' }}"
                   name="product-name">
          </div>
          <div class="mb-3">
            <label for="product-cover-photo" class="form-label">Produkta pirmās lapas
              bilde</label>
            <x-file-upload :name="'product-cover-photo'"
                           :files="json_encode(['product-images/'.$product->slug.'/'.$product->cover_photo_filename])"/>
            <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā
              izmērā.</p>
            <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/"
                                                              target="_blank">compressor.io</a>
            </p>
          </div>
          <div class="mb-3">
            <label for="product-cover-video" class="form-label">Produkta pirmās lapas
              video</label>
            <x-file-upload :name="'product-cover-video'"
                           :files="$product->cover_video_filename ? json_encode(['product-images/'.$product->slug.'/'.$product->cover_video_filename]) : null"/>
            <p class="small">Video ir jābūt .MP4 formātā un pēc iespējas mazākā
              izmērā.</p>
          </div>
          <div class="d-flex justify-content-between">
            <div></div>
            <div class="d-flex">
              <a href="{{ route('admin.products.index', ['locale' => app()->getLocale()]) }}" class="btn btn-dark">Atpakaļ</a>
              <button type="submit" class="btn btn-success mx-1">Atjaunot</button>
            </div>
          </div>
        </form>
        @if($product->cover_video_filename)
          <form action="{{ route('admin.products.destroyVideo', ['locale' => app()->getLocale(), 'product' => $product]) }}"
                method="POST" class="mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Vai tiešām vēlies noņemt video?')">
              Noņemt video pirmajā skatā
            </button>
          </form>
        @endif
      </div>
    </div>
  </x-slot>
</x-layouts.admin>
