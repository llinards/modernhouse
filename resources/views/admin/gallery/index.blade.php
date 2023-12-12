@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section>
      <div class="mt-5">
        <h2 class="text-center">Galerijas</h2>
      </div>
      <div>
        <div class="container">
          <div class="row justify-content-between">
            @if(app()->getLocale() == 'lv')
              <div class="mb-2">
                <a href="/admin/gallery/create" class="btn btn-success">Pievienot jaunu</a>
              </div>
            @endif
            @include('includes.status-messages')
            @foreach($galleryContents as $galleryItem)
              <div class="col-lg-4 p-2">
                <div class="card position-relative">
                  <div class="card-header">
                    @if($galleryItem->is_pinned)
                      <i class="bi bi-pin-angle-fill"></i>
                    @endif
                    @if($galleryItem->is_video)
                      <i class="bi bi-camera-video-fill"></i>
                    @else
                      <i class="bi bi-image-fill"></i>
                    @endif
                  </div>
                  <div class="card-body">
                    <p class="card-title text-center">

                      {{ $galleryItem->translations[0]->title ?? 'Nav tulkojuma!' }}
                    </p>
                    <hr>
                    <div class="d-flex justify-content-center mt-4">
                      <a href="/admin/gallery/{{ $galleryItem->id }}/edit" class="btn btn-dark m-1">Rediģēt</a>
                      <button type="button" data-bs-toggle="modal"
                              data-bs-target="#delete-gallery-modal-{{$galleryItem->id}}" class="btn btn-danger m-1">
                        Dzēst
                      </button>
                    </div>
                  </div>
                </div>
                @include('admin.gallery.delete-modal')
              </div>
            @endforeach
            {{ $galleryContents->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
