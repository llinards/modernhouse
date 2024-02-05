<x-admin-layout>
  <x-slot name="header">
    <h2 class="text-center">Rediģēt
      - {{ $product->translations[0]->name ?? 'Nav pievienots tulkojums!' }}</h2>
  </x-slot>
  <x-slot name="content">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7 col-12">
          @include('includes.status-messages')
          <form action="/admin" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input name="id" class="visually-hidden" value="{{ $product->id }}">
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
                     name="product-name"
                     oninput="generateSlug()">
            </div>
            @if(app()->getLocale() === 'lv')
              <div class="mb-3">
                <label for="product-slug" class="form-label">Produkta ID</label>
                <input type="text" class="form-control" id="product-slug"
                       name="product-slug" oninput="updateUrl()" value="{{ $product->slug }}">
                <p class="class">Produkta lapas adrese būs - {{env('APP_URL')}}/<strong><span
                      id="product-slug-url">{{ $product->slug }}</span></strong>
                </p>
              </div>
            @endif
            <div class="mb-3">
              <div class="row">
                <div class="col-6">
                  <p>Esošā pirmās lapas bilde</p>
                  <img class="img-fluid"
                       src="{{ asset('storage/product-images/'.$product->slug.'/'.$product->cover_photo_filename)}}"
                       alt=""/>
                </div>
                @if($product->cover_video_filename)
                  <div class="col-6">
                    <p>Esošais pirmās lapas video</p>
                    <video class="img-fluid" controls muted>
                      <source
                        src="{{asset('storage/product-images/'.$product->slug.'/'.$product->cover_video_filename)}}"
                        type="video/mp4">
                    </video>
                    <div>
                      <a class="btn btn-danger btn-sm mb-1"
                         href="{{ URL::to('/admin/'.$product->slug.'/video/delete') }}">
                        Noņemt video kā galveno kategorijas skatu
                      </a>
                    </div>
                  </div>
                @endif
              </div>
            </div>
            <div class="mb-3">
              <label for="product-cover-photo" class="form-label">Produkta pirmās lapas
                bilde</label>
              <x-file-upload :name="'product-cover-photo'"/>
              <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā
                izmērā.</p>
              <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/"
                                                                target="_blank">compressor.io</a>
              </p>
            </div>
            <div class="mb-3">
              <label for="product-cover-video" class="form-label">Produkta pirmās lapas
                video</label>
              <x-file-upload :name="'product-cover-video'"/>
              <p class="small">Video ir jābūt .MP4 formātā un pēc iespējas mazākā
                izmērā.</p>
            </div>
            <div class="d-flex justify-content-between">
              <button type="button" data-bs-toggle="modal" data-bs-target="#delete-product-modal"
                      class="btn btn-danger">Dzēst
              </button>
              <div class="d-flex">
                <a href="/admin" class="btn btn-dark">Atpakaļ</a>
                <button type="submit" class="btn btn-success mx-1">Atjaunot</button>
              </div>
            </div>
          </form>
          @include('admin.product.delete-modal')
        </div>
      </div>
    </div>
  </x-slot>
</x-admin-layout>
{{--TODO: Re-use this script--}}
<script>
  function generateSlug() {
    const productName = document.getElementById('product-name').value.trim().toLowerCase();
    const slug = productName
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '')
      .replace(/[^a-z0-9\s-]/g, '')
      .replace(/\s+/g, ' ')
      .replace(/\s/g, '-')
      .replace(/-+/g, '-')
      .replace(/^-|-$/g, '');
    document.getElementById('product-slug').value = slug;
    document.getElementById('product-slug-url').innerText = slug;
  }

  function updateUrl() {
    document.getElementById('product-slug-url').textContent = document.getElementById('product-slug').value.trim();
  }
</script>
