@extends('app', ['index' => null, 'title' => 'Svīres ielas projekts, Siguldā'])
@section('content')
  <div id="landing-page">
    <section id="introduction" class="d-flex flex-column justify-content-between"
             style="background-image:url('{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/introduction.jpg')}}');">
      <h1 class="fw-bold text-center text-uppercase title">svīres ielas projekts,<br/>siguldā</h1>
      <div class="text-center d-flex flex-column justify-content-end align-items-center">
        <a href="#"
           class="btn btn-secondary fw-light d-flex justify-content-center align-items-center"
        >Rezervēt privātmāju</a>
        <a href="#live-in-sigulda"
           class="pb-lg-5 pb-4 pt-3">
          <img width="35" height="35" src="{{ asset('storage/icons/arrow-down.svg') }}" alt="Arrow down">
        </a>
      </div>
    </section>
    <section id="live-in-sigulda">
      <div class="container-xxl w-100 h-100 d-flex align-items-center">
        <div class="row">
          <div class="col-lg-4 d-flex flex-column justify-content-center mt-lg-0 mt-3">
            <h2 class="fw-bold title mb-3">Piepildi sapni par māju Siguldā!</h2>
            <p class="mb-3">Piedāvājam veikt rezervāciju vienstāvīgu privātmāju iegādei jaunā dzīvojamajā projektā
              Siguldā, Svīres
              ielā.
              Iespējams izvēlēties no 5 zemesgabaliem.</p>
            <p>600 m attālumā no Siguldas Sporta skolas, 900 m attālumā no TC "Raibais suns" un starppilsētu autobusu
              pieturas, 1.6 km attālumā no pilsētas centra</p>
          </div>
          <div class="col-lg-8 order-first order-lg-last" id="landing-page-galleries">
            <div id="svires-ielas-projekts-gallery-main-carousel" class="splide">
              <div class="splide__track">
                <ul class="splide__list">
                  <li class="splide__slide">
                    <a data-fslightbox="svires-ielas-projekts"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/01.jpg') }}">
                      <img class="img-fluid"
                           data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/01.jpg') }}"
                           alt="Svires ielas projekts, Siguldā">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="svires-ielas-projekts"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/02.jpg') }}">
                      <img class="img-fluid"
                           data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/02.jpg') }}"
                           alt="Svires ielas projekts, Siguldā">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="svires-ielas-projekts"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/03.jpg') }}">
                      <img class="img-fluid"
                           data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/03.jpg') }}"
                           alt="Svires ielas projekts, Siguldā">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="svires-ielas-projekts"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/04.jpg') }}">
                      <img class="img-fluid"
                           data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/04.jpg') }}"
                           alt="Svires ielas projekts, Siguldā">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="svires-ielas-projekts"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/05.jpg') }}">
                      <img class="img-fluid"
                           data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/05.jpg') }}"
                           alt="Svires ielas projekts, Siguldā">
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
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

