@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section class="all-products">
      <div class="all-products-title my-5">
        <h2 class="text-center">Rediģēt - {{ $product->name }}</h2>
      </div>
      <div class="all-products-content my-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
              @include('includes.status-messages')
              <form action="/admin" method="POST" enctype="multipart/form-data" >
                @csrf
                @method('PATCH')
                <input name="id" class="visually-hidden" value="{{ $product->id }}">
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $product->is_active }}" id="product-available" name="product-available" {{ $product->is_active ? 'checked' : '' }} >
                    <label class="form-check-label" for="product-available">
                      Pieejams mājaslapā
                    </label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="product-name" class="form-label">Nosaukums</label>
                  <input type="text" class="form-control" id="product-name" value="{{ $product->name }}" name="product-name">
                </div>
                <div class="mb-3">
                  <p>Esošā pirmās lapas bilde</p>
                  <img class="img-fluid w-50" src="{{ asset('storage/product-images/'.$product->slug.'/'.$product->cover_photo_filename)}}" alt="" />
                </div>
                <div class="mb-3">
                  <label for="product-cover-photo" class="form-label">Produkta pirmās lapas bilde</label>
                  <input class="form-control" type="file" id="product-cover-photo" name="product-cover-photo">
                  <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā izmērā.</p>
                  <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/" target="_blank">compressor.io</a></p>
                </div>
                <div class="d-flex justify-content-between">
                  <button type="button" data-bs-toggle="modal" data-bs-target="#delete-product-modal" class="btn btn-danger">Dzēst</button>
                  <div class="d-flex">
                    <a href="/admin" class="btn btn-secondary">Atpakaļ</a>
                    <button type="submit" class="btn btn-success mx-1">Atjaunot</button>
                  </div>
                </div>
              </form>
              @include('admin.product.delete-modal')
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.create(document.querySelector('input[id="product-cover-photo"]'));
    FilePond.setOptions({
      server: {
        url: '/admin/upload',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      acceptedFileTypes: ['image/*'],
      allowImagePreview: true,
    });
  </script>
@endsection
