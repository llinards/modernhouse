@extends('layouts.app', ['title' => Lang::get('gallery'), 'index' => false])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('gallery')</h1>
      <div class="mt-4 gallery">
        @foreach($galleries as $gallery)
          <div class="row mt-5">
            <div class="col-lg-3 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-2">
              <h2 class="fw-bold title mb-2">{{ $gallery->translations[0]->title }}</h2>
              <p>{!! $gallery->translations[0]->content !!}</p>
            </div>
            @if($gallery->is_video)
              <div
                class="col-lg-9 d-flex order-first order-lg-last justify-content-center align-items-center flex-column">
                <video class="img-fluid" controls
                       src="{{ asset('storage/gallery/'. $gallery->slug . '/' .$gallery->images[0]->filename) }}#t=0.001"
                       title="{{ $gallery->translations[0]->title }}">Your browser does not support the
                  video tag.
                </video>
              </div>
            @else
              <div
                class="col-lg-9 d-flex order-first order-lg-last justify-content-center align-items-center flex-column"
                id="gallery-images">
                <section id="gallery-{{$gallery->slug}}-main-carousel" class="splide">
                  <div class="splide__track">
                    <ul class="splide__list">
                      @foreach($gallery->images as $image)
                        <li class="splide__slide">
                          <a data-fslightbox="{{$gallery->slug}}"
                             href="{{ asset('storage/gallery/'. $gallery->slug . '/' .$image->filename) }}">
                            <img class="img-fluid"
                                 data-splide-lazy="{{ asset('storage/gallery/'. $gallery->slug . '/' .$image->filename) }}"
                                 alt="{{ $gallery->title }}">
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </section>
              </div>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </div>
  @include('includes.footer')
  <script type="module">
    const galleryImages = document.querySelectorAll('#gallery-images');
    galleryImages.forEach((image) => {
      const main = new Splide('#' + image.firstElementChild.id, {
        type: 'fade',
        pagination: false,
        lazyLoad: 'nearby',
        heightRatio: 0.5,
      });
      main.mount();
    });
  </script>
@endsection

