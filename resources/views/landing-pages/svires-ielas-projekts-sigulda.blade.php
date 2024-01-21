@extends('app', ['index' => null, 'title' => 'Svīres ielas projekts, Siguldā'])
@section('content')
  <div id="landing-page">
    <section id="introduction" class="d-flex flex-column justify-content-between"
             style="background-image:url('{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/introduction.jpg')}}');">
      <h1 class="fw-bold text-center text-uppercase title">Piepildi sapni par māju<br/>Siguldā!</h1>
      <div class="text-center d-flex flex-column align-items-center">
        <a href="#"
           class="btn btn-secondary fw-light d-flex justify-content-center align-items-center"
        >Rezervēt privātmāju</a>
        <a href="#about-project"
           class="pb-lg-5 pb-4 pt-3">
          <img width="35" height="35" src="{{ asset('storage/icons/arrow-down.svg') }}" alt="Arrow down">
        </a>
      </div>
    </section>
    <section id="about-project">
      <div class="container-xxl w-100 h-100 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col-lg-5">
            <h2 class="fw-bold title mb-3">Par projektu</h2>
            <p class="mb-3">Piedāvājam veikt rezervācijas jaunā dzīvojamajā projektā Siguldā, Svīres ielā - vienstāvīgu
              privātmāju iegādei. Ir iespējams izvēlēties no 5 zemesgabaliem, VAJAG TEKSTU PAR PĀRĒJIEM ZEMES GABALIEM
              UN
              PĀRĒJĀM OPCIJĀM!!!!</p>
            <p class="mb-3">Jaunais privātmāju dzīvojamais projekts atradīsies lieliskā un klusā vietā. Šeit Tev būs
              iespēja baudīt
              ģimeniskas pastaigas projekta izveidotajā parkā, gan arī radīt atmiņas bērnu aptūas laukumā.</p>
            <p class="mb-3">1. kārtas ietvaros tiks uzbūvētas 5 vienstāvīgas, energoefektīvas un ilgtspējīgas
              privātmājas,
              kas nodrošinās māju sajūtu pilsētā! VAJAG TEKSTU PAR MĀJAS SAJŪTU UN ĢIMENI
              Projektu plānots nodot ekspluatācijā 2024. gada beigās.</p>
            <p class="mb-3">2.kārta VAJAG TEKSTU Izvēlies no 20 zemesgabaliem, no kuriem 5 ir pieejami jau.....</p>
          </div>
          <div class="col-lg-7 d-md-flex d-none flex-column justify-content-center mt-lg-0 mt-3">
            <div class="row">
              <div class="col-6 text-center">
                <img class="about-project-icon mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/house.svg')}}"
                     alt="">
                <p>dzīvojamā platība</p>
                <div class="mx-auto text-center w-75">
                  <hr class="m-1">
                </div>
                <h3 class="title fw-bold">101 - 180 m<sup>2</sup></h3>
              </div>
              <div class="col-6 text-center">
                <img class="about-project-icon mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/card.svg')}}"
                     alt="">
                <p>plānotās cenas</p>
                <div class="mx-auto text-center w-75">
                  <hr class="m-1">
                </div>
                <h3 class="title fw-bold">305 000 EUR</h3>
              </div>
            </div>
            <div class="row mt-lg-5 mt-4">
              <div class="col-6 text-center">
                <img class="about-project-icon mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/bed.svg')}}"
                     alt="">
                <p>istabas</p>
                <div class="mx-auto text-center w-75">
                  <hr class="m-1">
                </div>
                <h3 class="title fw-bold">3 guļamistabas</h3>
              </div>
              <div class="col-6 text-center">
                <img class="about-project-icon mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/check.svg')}}"
                     alt="">
                <p>energoefektivitāte</p>
                <div class="mx-auto text-center w-75">
                  <hr class="m-1">
                </div>
                <h3 class="title fw-bold">A + klase</h3>
              </div>
            </div>
            <div class="row mt-lg-5 mt-4">
              <div class="col-6 text-center">
                <img class="about-project-icon mb-lg-3 mb-2"
                     src="{{asset('storage/landing-pages/icons/map-pin-line copy.svg')}}"
                     alt="">
                <div class="mx-auto text-center w-75">
                  <hr class="m-1">
                </div>
                <h3 class="title fw-bold">labiekārtota teritorija</h3>
              </div>
              <div class="col-6 text-center">
                <img class="about-project-icon mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/key.svg')}}"
                     alt="">
                <div class="mx-auto text-center w-75">
                  <hr class="m-1">
                </div>
                <h3 class="title fw-bold">līdz atslēgai</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="about-project-mobile" class="d-md-none d-block">
      <div class="container-xxl w-100 h-100 d-flex flex-column justify-content-evenly">
        <div class="row">
          <div class="col-6 text-center">
            <img class="about-project-icon mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/house.svg')}}"
                 alt="">
            <p>dzīvojamā platība</p>
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">101 - 180 m<sup>2</sup></h3>
          </div>
          <div class="col-6 text-center">
            <img class="about-project-icon mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/card.svg')}}"
                 alt="">
            <p>plānotās cenas</p>
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">305 000 EUR</h3>
          </div>
        </div>
        <div class="row mt-lg-5 mt-4">
          <div class="col-6 text-center">
            <img class="about-project-icon mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/bed.svg')}}"
                 alt="">
            <p>istabas</p>
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">3 guļamistabas</h3>
          </div>
          <div class="col-6 text-center">
            <img class="about-project-icon mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/check.svg')}}"
                 alt="">
            <p>energoefektivitāte</p>
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">A + klase</h3>
          </div>
        </div>
        <div class="row mt-lg-5 mt-4">
          <div class="col-6 text-center">
            <img class="about-project-icon mb-lg-3 mb-2"
                 src="{{asset('storage/landing-pages/icons/map-pin-line copy.svg')}}"
                 alt="">
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">labiekārtota teritorija</h3>
          </div>
          <div class="col-6 text-center">
            <img class="about-project-icon mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/key.svg')}}"
                 alt="">
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">līdz atslēgai</h3>
          </div>
        </div>
      </div>
    </section>
    {{--    TODO: In progress..--}}
    <section id="gallery">
      <h1>gallerija in progress</h1>
      {{--      <div id="landing-page-galleries">--}}
      {{--        <div id="svires-ielas-projekts-gallery-main-carousel" class="splide">--}}
      {{--          <div class="splide__track">--}}
      {{--            <ul class="splide__list">--}}
      {{--              <li class="splide__slide">--}}
      {{--                <a data-fslightbox="svires-ielas-projekts"--}}
      {{--                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/01.jpg') }}">--}}
      {{--                  <img class="img-fluid"--}}
      {{--                       data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/01.jpg') }}"--}}
      {{--                       alt="Svires ielas projekts, Siguldā">--}}
      {{--                </a>--}}
      {{--              </li>--}}
      {{--              <li class="splide__slide">--}}
      {{--                <a data-fslightbox="svires-ielas-projekts"--}}
      {{--                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/02.jpg') }}">--}}
      {{--                  <img class="img-fluid"--}}
      {{--                       data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/02.jpg') }}"--}}
      {{--                       alt="Svires ielas projekts, Siguldā">--}}
      {{--                </a>--}}
      {{--              </li>--}}
      {{--              <li class="splide__slide">--}}
      {{--                <a data-fslightbox="svires-ielas-projekts"--}}
      {{--                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/03.jpg') }}">--}}
      {{--                  <img class="img-fluid"--}}
      {{--                       data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/03.jpg') }}"--}}
      {{--                       alt="Svires ielas projekts, Siguldā">--}}
      {{--                </a>--}}
      {{--              </li>--}}
      {{--              <li class="splide__slide">--}}
      {{--                <a data-fslightbox="svires-ielas-projekts"--}}
      {{--                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/04.jpg') }}">--}}
      {{--                  <img class="img-fluid"--}}
      {{--                       data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/04.jpg') }}"--}}
      {{--                       alt="Svires ielas projekts, Siguldā">--}}
      {{--                </a>--}}
      {{--              </li>--}}
      {{--              <li class="splide__slide">--}}
      {{--                <a data-fslightbox="svires-ielas-projekts"--}}
      {{--                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/05.jpg') }}">--}}
      {{--                  <img class="img-fluid"--}}
      {{--                       data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/05.jpg') }}"--}}
      {{--                       alt="Svires ielas projekts, Siguldā">--}}
      {{--                </a>--}}
      {{--              </li>--}}
      {{--            </ul>--}}
      {{--          </div>--}}
      {{--        </div>--}}
      {{--      </div>--}}
    </section>
    <section id="around-neighborhood" class="d-flex flex-column">
      <h2 class="fw-bold title text-center mb-3 pt-5">Iepazīsti apkaimi</h2>
      <div class="h-100 mb-3">
        <iframe src="https://snazzymaps.com/embed/564387" width="100%" height="100%"></iframe>
      </div>
      <div class="container-xxl mb-5">
        <div class="row justify-content-evenly">
          <div class="col-lg-3 col-6 mb-lg-0 mb-3 text-center">
            <h3 class="title">2,3 km</h3>
            <p class="fw-bold">T/C "Šokolāde"</p>
          </div>
          <div class="col-lg-3 col-6 mb-lg-0 mb-3 text-center">
            <h3 class="title">600 m</h3>
            <p class="fw-bold">Siguldas Sporta skola</p>
          </div>
          <div class="col-lg-3 col-6 text-center">
            <h3 class="title">2,4 km</h3>
            <p class="fw-bold">Siguldas Valsts ģimnāzija</p>
          </div>
          <div class="col-lg-3 col-6 text-center">
            <h3 class="title">1,6 km</h3>
            <p class="fw-bold">pilsētas centrs</p>
          </div>
          <div>
            <hr class="m-3">
          </div>
          <a href="#"
             class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
          >Rezervēt privātmāju</a>
        </div>
      </div>
    </section>
    <section>
      @include('includes.footer')
    </section>
  </div>
  <script type="module">
    const landingPageGalleryImages = document.querySelectorAll('#landing-page-galleries');
    landingPageGalleryImages.forEach((image) => {
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

