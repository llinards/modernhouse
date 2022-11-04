@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section class="all-products">
      <div class="all-products-title my-5">
        <h2 class="text-center">Pievienot jaunu māju/moduli</h2>
      </div>
      <div class="all-products-content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-7">
              <form action="/admin" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="product-name" class="form-label">Nosaukums</label>
                  <input type="email" class="form-control" id="product-name" name="product-name">
                </div>
                <div class="mb-3">
                  <label for="product-cover-photo" class="form-label">Produkta pirmās lapas bilde</label>
                  <input class="form-control" type="file" id="product-cover-photo" name="product-cover-photo">
                  <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā izmērā.</p>
                  <p class="small">Tās var samazināt šajā lapā - <a href="https://tinypng.com" target="_blank">tinypng.com/</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
