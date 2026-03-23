<x-layouts.admin>
  <x-slot name="header">
    Pievienot jaunu kategoriju
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-12">
        @include('includes.status-messages')
        <form action="/admin/{{ app()->getLocale() }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="product-name" class="form-label">Nosaukums</label>
            <input type="text" class="form-control" id="product-name" name="product-name">
          </div>
          <div class="mb-3">
            <label for="product-cover-photo" class="form-label">Produkta pirmās lapas
              bilde</label>
            <x-file-upload :name="'product-cover-photo'" :required="'true'"/>
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
          <a href="/admin/{{ app()->getLocale() }}" class="btn btn-dark">Atpakaļ</a>
          <button type="submit" class="btn btn-success">Pievienot</button>
        </form>
      </div>
    </div>
  </x-slot>
</x-layouts.admin>

