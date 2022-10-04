@extends('app')
@section('content')
  @include('includes.navbar-desktop', ['index' => false])
  @include('includes.navbar-mobile', ['index' => false])
  <div class="container-xxl content">
    <div class="row">
      <div class="title">
        <h1 class="fw-bold text-center text-uppercase">Model 1</h1>
      </div>
      <div class="product-levels">
        <ul class="nav mt-4 nav-tabs d-flex product-level-titles flex-nowrap">
          <li class="nav-item">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#premium" type="button">Model 1 - 1</button>
          </li>
          <li class="nav-item">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#standart" type="button">Model 1 - 2</button>
          </li>
          <li class="nav-item">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#economy" type="button">Model 1 - 3</button>
          </li>
        </ul>
        <div class="tab-content product-level">
          <div class="tab-pane fade show active" id="premium">
            <div class="row">
              <div class="col-lg-7 mt-4">
                <section id="main-carousel" class="splide">
                  <div class="splide__track">
                    <ul class="splide__list">
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/1.jpg') }}" alt="">
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/2.jpg') }}" alt="">
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/3.jpg') }}" alt="">
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/4.jpg') }}" alt="">
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/5.jpg') }}" alt="">
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/6.jpg') }}" alt="">
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/7.jpg') }}" alt="">
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/8.jpg') }}" alt="">
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/9.jpg') }}" alt="">
                      </li>
                    </ul>
                  </div>
                </section>
                <section id="thumbnail-carousel" class="splide mt-2">
                  <div class="splide__track">
                    <ul class="splide__list">
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/1.jpg') }}"/>
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/2.jpg') }}"/>
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/3.jpg') }}"/>
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/4.jpg') }}"/>
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/5.jpg') }}"/>
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/6.jpg') }}"/>
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/7.jpg') }}"/>
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/8.jpg') }}"/>
                      </li>
                      <li class="splide__slide">
                        <img class="img-fluid" src="{{ asset('storage/model-1/9.jpg') }}"/>
                      </li>
                    </ul>
                  </div>
                </section>
              </div>
              <div class="col-lg-5 mt-4 d-flex flex-column justify-content-around">
                <div class="product-short-description">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi
                    debitis
                    rem esse consequuntur
                    odit
                    alias voluptas dolor laudantium sit! Deserunt cum odio et?</p>
                </div>
                <div class="product-price">
                  <h1 class="text-center">EUR 250 000,00</h1>
                </div>
                <div class="product-order d-flex flex-column justify-content-end align-items-center">
                  <h4 class="fw-bold text-center mb-2">Order your Model 1</h4>
                  <button type="submit"
                    class="btn btn-primary btn-main btn-secondary fw-light d-flex justify-content-center align-items-center text-uppercase">@lang('order
                    now')</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
