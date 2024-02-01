@extends('layouts.app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section>
      <div class="my-5">
        <h2 class="text-center">Rediģēt - {{ $gallery->translations[0]->title ?? 'Nav tulkojuma!' }}</h2>
      </div>
      <div class="my-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
              @include('includes.status-messages')
              <form action="/admin/gallery" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input name="id" class="visually-hidden" value="{{ $gallery->id }}">
                <div class="row mb-3">
                  <div class="col-6">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gallery-type"
                             name="gallery-type"
                             value="{{ $gallery->is_video }}" {{ $gallery->is_video ? 'checked' : '' }}>
                      <label class="form-check-label" for="gallery-type">
                        <i class="bi bi-camera-video-fill"></i> Video galerija
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gallery-pinned"
                             name="gallery-pinned"
                             value="{{ $gallery->is_pinned }}" {{ $gallery->is_pinned ? 'checked' : '' }}>
                      <label class="form-check-label" for="gallery-pinned">
                        <i class="bi bi-pin-angle"></i> Rādīt galeriju kā pirmo
                      </label>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="gallery-title" class="form-label">Nosaukums</label>
                  <input type="text" class="form-control" id="gallery-title"
                         value="{{ $gallery->translations[0]->title ?? 'Nav tulkojuma!' }}"
                         name="gallery-title">
                </div>
                <div class="mb-3">
                  <label for="gallery-content" class="form-label">Apraksts</label>
                  <x-description-text-area
                    :name="'gallery-content'"> {{ $gallery->translations[0]->content ?? 'Nav tulkojuma!' }}</x-description-text-area>
                </div>
                <div class="mb-3" id="gallery-images">
                  <p>Esošās bildes / video</p>
                  <div class="row">
                    @if(count($gallery->images) === 0)
                      <p>Nav pievienotas bildes!</p>
                    @else
                      @foreach($gallery->images as $image)
                        <div class="col-lg-4 col-md-3 col-sm-6 col-6">
                          <a class="btn btn-danger btn-sm mb-1"
                             href="{{ URL::to('/admin/gallery/'.$image->id.'/delete') }}">
                            <i class="bi bi-x"></i>
                          </a>
                          @if($gallery->is_video)
                            <video class="img-fluid mb-2" controls
                                   src="{{ asset('storage/gallery/'.$gallery->slug.'/'.$image->filename) }}"
                            />
                          @else
                            <img class="img-fluid mb-2"
                                 src="{{ asset('storage/gallery/'.$gallery->slug.'/'.$image->filename) }}"
                                 alt="">
                          @endif
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
                <div class="mb-3">
                  <label for="gallery-images" class="form-label">Bildes</label>
                  <x-file-upload :name="'gallery-images'"/>
                  <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā
                    izmērā.</p>
                  <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/"
                                                                    target="_blank">compressor.io</a>
                  </p>
                </div>
                <a href="/admin/gallery" class="btn btn-dark">Atpakaļ</a>
                <button type="submit" class="btn btn-success">Atjaunot</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
