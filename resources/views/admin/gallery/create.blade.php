<x-layouts.admin>
  <x-slot name="header">
    <h2 class="text-center">Pievienot jaunu galeriju</h2>
  </x-slot>
  <x-slot name="content">

    <div class="row justify-content-center">
      <div class="col-lg-7 col-12">
        @include('includes.status-messages')
        <form action="/admin/gallery" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row mb-3">
            <div class="col-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gallery-type"
                       name="gallery-type">
                <label class="form-check-label" for="gallery-type">
                  <i class="bi bi-camera-video-fill"></i> Video galerija
                </label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gallery-pinned"
                       name="gallery-pinned">
                <label class="form-check-label" for="gallery-pinned">
                  <i class="bi bi-pin-angle"></i> Rādīt galeriju kā pirmo
                </label>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="gallery-title" class="form-label">Nosaukums</label>
            <input type="text" class="form-control" id="gallery-title"
                   value="{{ old('gallery-title') }}"
                   name="gallery-title">
          </div>
          <div class="mb-3">
            <label for="gallery-content" class="form-label">Apraksts</label>
            <x-description-text-area
              :name="'gallery-content'">{{ old('gallery-content') }}</x-description-text-area>
          </div>
          <div class="mb-3">
            <label for="gallery-images" class="form-label">Bildes</label>
            <x-file-upload :name="'gallery-images'" :required="'true'"/>
            <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā
              izmērā.</p>
            <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/"
                                                              target="_blank">compressor.io</a>
            </p>
          </div>
          <a href="/admin/gallery" class="btn btn-dark">Atpakaļ</a>
          <button type="submit" class="btn btn-success">Pievienot</button>
        </form>
      </div>
    </div>
  </x-slot>
</x-layouts.admin>
