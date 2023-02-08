@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section>
      <div class="mt-5">
        <h2 class="text-center">Galerija</h2>
      </div>
      <div>
        <div class="container">
          <div class="row justify-content-between">
            <div class="mb-2">
              <a href="/admin/gallery/create" class="btn btn-success">Pievienot jaunu</a>
            </div>
            @include('includes.status-messages')
            @foreach($allGalleryContent as $galleryItem)
              <div class="col-lg-3 p-2">
                <div class="card position-relative">
                  <div class="card-body">
                    <h3 class="card-title text-center">{{ $galleryItem->title }}</h3>
                    <hr>
                    <div class="d-flex justify-content-center mt-4">
                      <a href="/admin/gallery/{{ $galleryItem->id }}/edit" class="btn btn-secondary">Rediģēt</a>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
