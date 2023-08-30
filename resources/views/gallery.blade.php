@extends('app', ['title' => Lang::get('gallery'), 'index' => false, 'allProducts' => $allProducts])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('gallery')</h1>
      <div class="mt-4 gallery">
        @foreach($galleryContents as $galleryItem)
          <div class="row mt-5">
            <div class="col-lg-3 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-2">
              <h2 class="fw-bold title mb-2">{{ $galleryItem->translations[0]->title }}</h2>
              <p>{!! $galleryItem->translations[0]->content !!}</p>
            </div>
            @if($galleryItem->is_video)
              <div
                class="col-lg-9 d-flex order-first order-lg-last justify-content-center align-items-center flex-column">
                <video class="img-fluid" controls
                       src="{{ asset('storage/gallery/'. $galleryItem->slug . '/' .$galleryItem->galleryImages[0]->filename) }}"
                       title="{{ $galleryItem->translations[0]->title }}"/>
              </div>
            @else
              <div
                class="col-lg-9 d-flex order-first order-lg-last justify-content-center align-items-center flex-column"
                id="gallery-images">
                <section id="{{$galleryItem->slug}}-main-carousel" class="splide">
                  <div class="splide__track">
                    <ul class="splide__list">
                      @foreach($galleryItem->galleryImages as $image)
                        <li class="splide__slide">
                          <a data-fslightbox="{{$galleryItem->slug}}"
                             href="{{ asset('storage/gallery/'. $galleryItem->slug . '/' .$image->filename) }}">
                            <img class="img-fluid"
                                 data-splide-lazy="{{ asset('storage/gallery/'. $galleryItem->slug . '/' .$image->filename) }}"
                                 alt="{{ $galleryItem->title }}">
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
@endsection
