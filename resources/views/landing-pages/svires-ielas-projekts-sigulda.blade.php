@extends('app', ['index' => null, 'title' => 'Svīres ielas projekts, Siguldā'])
@section('content')
  <div id="landing-page">
    <section id="introduction" class="full-height-section d-flex flex-column justify-content-between"
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
    <section id="about-project" class="full-height-section">
      <div class="container-xxl w-100 h-100 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col-lg-5 d-flex flex-column justify-content-evenly">
            <div class="mb-4">
              <h2 class="fw-bold title">Par projektu</h2>
            </div>
            <div>
              <p class="mb-4">Piedāvājam veikt rezervācijas jaunā dzīvojamo māju projektā Siguldā, Svīres ielā.</p>
              <p class="mb-4">
                Jaunais privātmāju dzīvojamais rajons atradīsies lieliskā un klusā vietā. Šeit būs iespēja baudīt
                ģimeniskas pastaigas projekta izveidotajā parka, kā arī radīt atmiņas bērnu atpūtas laukumā.</p>
              <p class="mb-4">Šajā projektā varat izvēlēties no kāda no pieciem zemes gabaliem ar vienstāvīgu
                privātmāju, kuras plānots nodot ekspluatācijā 2024. gada beigās.
              </p>
              <p>Tāpat pieejami vēl vairāki brīvi zemes gabali, kuros iespējams uzbūvēt kādu mājokli no
                mūsu piedāvājuma klāsta, Jūsu jau esošu ilgi loloto sapni vai arī varam palīdzēt ar savu pieredzi un
                kopīgi izstrādāt individuālu projektu tieši Jums.</p>
            </div>
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
                     src="{{asset('storage/landing-pages/icons/map-pin-line.svg')}}"
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
    <section id="about-project-mobile" class="full-height-section d-md-none d-block">
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
                 src="{{asset('storage/landing-pages/icons/map-pin-line.svg')}}"
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
    <section id="gallery" class="full-height-section">
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
    <section id="around-neighborhood" class="full-height-section d-flex flex-column">
      <div class="mb-4 pt-3">
        <h2 class="fw-bold title text-center">Iepazīsti apkaimi</h2>
      </div>
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
    <section id="full-project" class="full-height-section">
      <div class="container-xxl w-100 h-100 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col-lg-5 d-flex flex-column justify-content-evenly">
            <div class="mb-4">
              <h2 class="fw-bold title">No pamatiem<br/>līdz atslēgai</h2>
            </div>
            <div>
              <p class="mb-4">Energoefektīva koka karkasa zviedru kvalitātes ģimenes māja ar trīs guļamistabām, plaša
                dzīvojamā telpa apvienota ar virtuvi, trīs sanmezgliem –
                divi ar dušu un viens ar veļas telpu.</p>
              <p class="mb-4"><strong>MĀJAI BŪS PILNĪBĀ PABEIGTI ĀRDARBI</strong><br/>
                ārējā apdare apzaļumots, nobruģēts pagalms, uzstādīta sēta un automātiskie iebraucamie vārti.</p>
              <p class="mb-4"><strong>MĀJAI BŪS PILNĪBĀ PABEIGTI IEKŠDARBI</strong><br/>
                krāsotas sienas, griesti, noflīzēti un aprīkoti sanmezgli, ieklāts grīdas segums, uzstādīta virtuves
                iekārta ar virtuves tehniku, masīvkoka iekšdurvis, iebūvējamie gaismekļi sanmezglos un gaitenī.</p>
              <p><strong>KOMUNIKĀCIJAS</strong><br/>
                elektrība, santehnika, rekuperācijas iekārta, gaiss- ūdens siltumsūknis ar siltajām grīdām.</p>
            </div>
          </div>
          <div class="col-lg-7 d-lg-flex d-none flex-column justify-content-center">
            <img src="{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/01.jpg')}}"/>
          </div>
        </div>
      </div>
    </section>
    <section class="full-height-section">
      <img class="full-size-image-background"
           src="{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/016.jpg')}}"
           alt="">
    </section>
    <section id="available-projects" class="full-height-section d-flex flex-column">
      <div class="h-100 mb-3">
        karte
      </div>
      <div class="container-xxl mb-5">
        <div class="row justify-content-evenly">
          <div class="col-lg-3 col-6 mb-lg-0 mb-3 text-center">
            <h3 class="title">1</h3>
            <p class="fw-bold">privātmāja</p>
          </div>
          <div class="col-lg-3 col-6 mb-lg-0 mb-3 text-center">
            <h3 class="title">6</h3>
            <p class="fw-bold">projekti</p>
          </div>
          <div class="col-lg-3 col-6 text-center">
            <h3 class="title">20</h3>
            <p class="fw-bold">zemes gabali</p>
          </div>
          <div class="col-lg-3 col-6 text-center">
            <h3 class="title">2 - 4</h3>
            <p class="fw-bold">guļamistabas</p>
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
    <section id="live-in-sigulda" class="full-height-section"
             style="background-image:url({{asset('storage/landing-pages/svires-ielas-projekts-sigulda/016.jpg')}})">
      <div class="container-xxl w-100 h-100 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col-lg-6 col-12 p-4">
            <h2 class="fw-bold title text-white mb-4">Kāpēc dzīvot<br/>Siguldā?</h2>
            <ul class="p-0 m-0">
              <li class="d-flex justify-content-between">
                <div class="ml-3">
                  <img src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="">
                </div>
                <p class="text-white mb-3">Dabas bagātība - Sigulda piedāvā mierīgu un drošu vidi, kas ir ideāla
                  ģimenēm.
                  Ainavas, parki un
                  daudzās pastaigu takas sniedz iespēju baudīt dabas skaistumu un tās piedāvāto relaksējošo mieru.</p>
              </li>
              <li class="d-flex justify-content-between">
                <div class="mr-3">
                  <img src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="">
                </div>
                <p class="text-white mb-3">Labas izglītības iespējas - Sigulda piedāvā kvalitatīvas izglītības iestādes,
                  tostarp skolas un
                  bērnudārzus, kā arī sporta, mākslas un mūzikas skolas, kas veicina bērnu attīstību un nodrošina viņu
                  labu sagatavotību nākotnei.
                </p>
              </li>
              <li class="d-flex justify-content-between">
                <div class="mr-3">
                  <img src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="">
                </div>
                <p class="text-white mb-3">Aktīvās atpūtas iespējas - pilsēta ir bagāta ar dažādām aktivitātēm un sporta
                  iespējām, kas ir
                  piemērotas kā bērniem tā piegušajiem un veicina aktīvu un veselīgu dzīvesveidu.</p>
              </li>
              <li class="d-flex justify-content-between">
                <div class="mr-3">
                  <img src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="">
                </div>
                <p class="text-white">Kultūras un sabiedriskā dzīve - Sigulda regulāri rīko dažādus kultūras un
                  sabiedriskos pasākumus,
                  piedāvājot ģimenēm iespēju piedalīties kopīgās aktivitātēs un veicināt savstarpējo saikni ar pilsētas
                  kopienas locekļiem.</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section class="full-height-section">
      citāts
    </section>
    <section id="quality-standards" class="full-height-section"
             style="background-image:url({{asset('storage/landing-pages/svires-ielas-projekts-sigulda/013.jpg')}})">
      <div class="container-xxl w-100 h-100 d-flex flex-column justify-content-center position-relative">
        <div class="row">
          <div class="offset-lg-6 col-lg-6 col-12 p-4">
            <h2 class="fw-bold title text-white mb-4">Skandināvu<br/>kvalitātes standarti</h2>
            <p class="text-white mb-4">
              MODERN HOUSE realizē projektus, kuri ir veidoti ar kvalitāti, estētiku, komfortu un ilgtspējību.</p>
            <p class="text-white mb-4">Mūsu vairāk kā 10 gadu ilgā pieredze un nodotās 500 + koka karkasa mājas
              Zviedrijā,
              kalpo kā kvalitātes zīme, ko piedāvājam saviem klientiem Latvijā.
            </p>
            <p class="text-white">Projektos izvēlamies strādāt tikai ar labākajiem materiāliem un tieši tāpēc vēlamies
              piesaistīt klientus, kuriem ir svarīga kvalitāte!</p>
          </div>
        </div>
        <div class="row position-absolute">
          <a href="#technical-specification"
             class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
          >Tehniskā specifikācija</a>
        </div>
      </div>
    </section>
    {{--    <section id="technical-specification">--}}
    {{--      <div class="container-xxl w-100 h-100">--}}
    {{--        <div class="row">--}}
    {{--          <h2 class="fw-bold title text-center mb-2 pt-4">Tehniskā specifikācija</h2>--}}
    {{--          <x-product-variant-option-buttons :productVariant="$productVariant"/>--}}
    {{--          <x-product-variant-options :productVariant="$productVariant"/>--}}
    {{--        </div>--}}
    {{--      </div>--}}
    {{--    </section>--}}
    <section class="footer">
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

