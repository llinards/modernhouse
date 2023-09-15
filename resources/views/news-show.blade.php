@extends('app', ['title' => $newsItem->title, 'index' => false])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">{{ $newsItem->title }}</h1>
      <div class="mt-4 gallery">
        <div class="row justify-content-center">
          <div
            class="col-lg-8"
            id="gallery-images">
            <section id="news-show-{{$newsItem->slug}}-main-carousel" class="splide">
              <div class="splide__track">
                <ul class="splide__list">
                  @foreach($newsItem->newsImages as $image)
                    <li class="splide__slide">
                      <img class="img-fluid"
                           data-splide-lazy="{{ asset('storage/news/'.$newsItem->slug.'/'.$image->image_location) }}"
                           alt="{{ $newsItem->title }}">
                    </li>
                  @endforeach
                </ul>
              </div>
            </section>
            <div class="d-flex w-100 justify-content-lg-between justify-content-center mt-2 flex-wrap">
              @foreach($newsItem->newsAttachments as $attachment)
                <a class="nav-link text-center m-lg-0 m-2" target="_blank"
                   href="{{ asset('storage/news/'.$newsItem->slug.'/'.$attachment->attachment_location) }}">
                  <i class="bi bi-download"></i>
                  <p class="small">{{basename($attachment->attachment_location)}}</p></a>
              @endforeach
            </div>
          </div>
        </div>
        <div class="row mt-4 justify-content-center">
          <div class="col-lg-8">
            <p>{!! $newsItem->content !!}</p>
          </div>
        </div>
        <div class="d-flex w-100 justify-content-center mt-4 flex-wrap">
          <a href="/{{app()->getLocale()}}/news"
             class="btn btn-primary fw-light d-flex justify-content-center align-items-center ">@lang('back')</a>
        </div>
      </div>
    </div>
  </div>
  @include('includes.footer')
@endsection
