@extends('layouts.app', ['title' => Lang::get('news'), 'index' => false])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('news')</h1>
      <div class="mt-4 gallery">
        @foreach($allNews as $news)
          <div class="row mt-5">
            <div class="col-lg-4 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-2">
              <h2 class="fw-bold title mb-2">{{ $news->title }}</h2>
              <div class="d-flex w-100 justify-content-lg-between justify-content-center mt-2 flex-wrap">
                <a href="/{{app()->getLocale()}}/news/{{$news->slug}}"
                   class="btn btn-primary fw-light d-flex justify-content-center align-items-center ">@lang('read more')</a>
              </div>
            </div>
            <div class="col-lg-8 d-flex order-first order-lg-last justify-content-center flex-column "
                 id="gallery-images">
              <section id="news-index-{{$news->slug}}-main-carousel" class="splide">
                <div class="splide__track">
                  <ul class="splide__list">
                    @foreach($news->images as $image)
                      <li class="splide__slide">
                        <img class="img-fluid"
                             data-splide-lazy="{{ asset('storage/news/'.$news->slug.'/'.$image->image_location) }}"
                             alt="{{ $news->title }}">
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
