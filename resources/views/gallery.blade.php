@extends('app', ['title' => Lang::get('gallery'), 'index' => false, 'allProducts' => $allProducts])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('gallery')</h1>
      <div class="mt-4 gallery">
        @foreach($galleryContent as $galleryItem)
        <div class="row mt-5">
          <div class="col-lg-3 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-2">
            <h2 class="fw-bold title mb-2">{{ $galleryItem->title }}</h2>
            <p>{!! $galleryItem->content !!}</p>
          </div>
          <div class="col-lg-9 d-flex order-first order-lg-last justify-content-center align-items-center flex-column" id="gallery-images">
            <section id="{{Str::slug($galleryItem->title)}}-main-carousel" class="splide">
              <div class="splide__track">
                <ul class="splide__list">
                  @foreach($galleryItem->galleryImages as $image)
                    <li class="splide__slide">
                      <img class="img-fluid" data-splide-lazy="{{ asset('storage/gallery/'. Str::slug($galleryItem->title) . '/' .$image->filename) }}"  alt="{{ $galleryItem->title }}">
                    </li>
                  @endforeach
                </ul>
              </div>
            </section>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @include('includes.footer')
@endsection
