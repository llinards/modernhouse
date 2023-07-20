@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section class="all-products">
      <div class="all-products-title my-5">
        <h2 class="text-center">Pievienot jaunu māju/moduli</h2>
      </div>
      <div class="all-products-content my-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
              @include('includes.status-messages')
              <form action="/admin" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="product-name" class="form-label">Nosaukums</label>
                  <input type="text" class="form-control" id="product-name" name="product-name"
                         oninput="generateSlug()">
                </div>
                <div class="mb-3">
                  <label for="product-slug" class="form-label">Produkta ID</label>
                  <input type="text" class="form-control" id="product-slug" name="product-slug" oninput="updateUrl()">
                  <p class="class">Produkta lapas adrese būs - {{env('APP_URL')}}/<strong><span
                        id="product-slug-url"></span></strong>
                  </p>
                </div>
                <div class="mb-3">
                  <label for="product-cover-photo" class="form-label">Produkta pirmās lapas bilde</label>
                  <input class="form-control" type="file" id="product-cover-photo" name="product-cover-photo">
                  <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā izmērā.</p>
                  <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/" target="_blank">compressor.io</a>
                  </p>
                </div>
                <a href="/admin" class="btn btn-secondary">Atpakaļ</a>
                <button type="submit" class="btn btn-success">Pievienot</button>
              </form>
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
      required: true,
      allowImagePreview: true,
      acceptedFileTypes: ['image/*'],
    });

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
@endsection
