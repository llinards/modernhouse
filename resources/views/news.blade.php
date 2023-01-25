@extends('app', ['title' => Lang::get('news'), 'index' => false, 'allProducts' => $allProducts])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('news')</h1>
      <div class="mt-4 gallery">
        @foreach($newsContent as $newsItem)
          <div class="row mt-5">
            <div class="col-lg-3 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-2">
              <h2 class="fw-bold title mb-2">{{ $newsItem->title }}</h2>
              <p>{!! $newsItem->content !!}</p>
              @foreach($newsItem->newsAttachments as $attachment)
                <div class="d-flex w-100 justify-content-lg-end justify-content-center">
                  <a class="nav-link text-center" target="_blank" href="{{ asset('storage/news/'.$attachment->attachment_location) }}">
                    <i class="bi bi-download"></i><p>Prezentācija</p></a>
                </div>
              @endforeach
            </div>
            <div class="col-lg-9 d-flex order-first order-lg-last justify-content-center align-items-center flex-column " id="gallery-images">
              <section id="{{Str::slug($newsItem->title)}}-main-carousel" class="splide">
                <div class="splide__track">
                  <ul class="splide__list">
                    @foreach($newsItem->newsImages as $image)
                      <li class="splide__slide">
                        <img class="img-fluid" data-splide-lazy="{{ asset('storage/news/'.$image->image_location) }}" alt="{{ $newsItem->title }}">
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
