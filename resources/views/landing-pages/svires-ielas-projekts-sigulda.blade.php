@extends('layouts.landing-page-app', ['title' => 'Svīres ielas projekts, Siguldā'])
@section('content')
  <div id="landing-page">
    {{--    Introduction--}}
    <section id="introduction" class="full-height-section d-flex flex-column justify-content-between"
             style="background-image:url('{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/introduction.jpg')}}');">
      <h1 class="fw-bold text-center title">Piepildi sapni par <br/>māju Siguldā!</h1>
      <div class="text-center d-flex flex-column align-items-center position-relative">
        <div class="d-flex justify-content-center align-items-center mb-lg-0 mb-3 location">
          <img class="location-icon" src="{{asset('storage/landing-pages/icons/map.svg')}}" alt="Location icon">
          <p class="location-name ml-3 text-white fw-bold">Svīres ielas projekts</p>
        </div>
        <div>
          <a href="#contact-us"
             class="btn btn-secondary fw-light d-flex justify-content-center align-items-center"
          >Pieteikties konsultācijai</a>
        </div>
        <a href="#about-project"
           class="pb-lg-5 pb-4 pt-3">
          <img width="35" height="35" src="{{ asset('storage/icons/arrow-down.svg') }}" alt="Arrow down">
        </a>
      </div>
    </section>
    {{--    About project--}}
    <section id="about-project" class="full-height-section">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col-lg-5 d-flex flex-column justify-content-evenly">
            <div class="mb-2">
              <h2 class="fw-bold title">Par projektu</h2>
            </div>
            <div>
              <p class="mb-2">Piedāvājam veikt rezervācijas jaunā dzīvojamo māju projektā Siguldā, Svīres
                ielā.</p>
              <p class="mb-2">
                Jaunais privātmāju dzīvojamais projekts atradīsies lieliskā un klusā vietā. Šeit būs iespēja baudīt
                ģimeniskas pastaigas projekta izveidotajā parkā, kā arī radīt atmiņas bērnu atpūtas laukumā.
                Šajā projektā varat izvēlēties kādu no pieciem zemes gabaliem ar vienstāvīgu privātmāju, kuras plānots
                nodot ekspluatācijā 2024. gada beigās.</p>
              <p class="mb-2">Tāpat pieejami vēl vairāki brīvi zemes gabali, kuros iespējams uzbūvēt kādu
                mājokli no
                mūsu tipveida projektiem, kā arī piedāvājam iespēju īstenot Jūsu sapņu māju, kopīgi radot individuālu
                projektu.
              </p>
              <p class="mb-5">Šajā projektā arī ir iespējams iegādāties kādu no brīvajiem zemes gabaliem ar
                platību 1200
                m<sup>2</sup>, kura cena ir 50 000 EUR,
                iespējama arī daļēja nomaksa atsevišķi vienojoties. Brīvos zemes gabalus iespējams aplūkot Svīres ielā
                vai arī projekta digitālajā kartē.</p>
              <div class="d-flex justify-content-center">
                <a href="#available-projects"
                   class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
                >Digitālā karte</a>
              </div>
            </div>
          </div>
          <div class="col-lg-7 d-md-flex d-none flex-column justify-content-center mt-lg-0 mt-3">
            <div class="row">
              <div class="col-6 text-center">
                <img class="icons mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/house.svg')}}"
                     alt="House icon">
                <p>dzīvojamā platība</p>
                <div class="mx-auto text-center w-75">
                  <hr class="m-1">
                </div>
                <h3 class="title fw-bold">101 - 180 m<sup>2</sup></h3>
              </div>
              <div class="col-6 text-center">
                <img class="icons mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/card.svg')}}"
                     alt="Card icon">
                <p>cena no</p>
                <div class="mx-auto text-center w-75">
                  <hr class="m-1">
                </div>
                <h3 class="title fw-bold">249 000 EUR</h3>
              </div>
            </div>
            <div class="row mt-lg-5 mt-4">
              <div class="col-6 text-center">
                <img class="icons mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/bed.svg')}}"
                     alt="Bed icon">
                <p>guļamistabas</p>
                <div class="mx-auto text-center w-75">
                  <hr class="m-1">
                </div>
                <h3 class="title fw-bold">3 - 4</h3>
              </div>
              <div class="col-6 text-center">
                <img class="icons mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/check.svg')}}"
                     alt="Checkmark icon">
                <p>energoefektivitāte</p>
                <div class="mx-auto text-center w-75">
                  <hr class="m-1">
                </div>
                <h3 class="title fw-bold">A klase</h3>
              </div>
            </div>
            <div class="row mt-lg-5 mt-4">
              <div class="col-6 text-center">
                <img class="icons mb-lg-3 mb-2"
                     src="{{asset('storage/landing-pages/icons/map-pin-line.svg')}}"
                     alt="Location icon">
                <div class="mx-auto text-center w-75">
                  <hr class="m-1">
                </div>
                <h3 class="title fw-bold">labiekārtota teritorija</h3>
              </div>
              <div class="col-6 text-center">
                <img class="icons mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/key.svg')}}"
                     alt="Key icon">
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
    {{--    About project (mobile only)--}}
    <section class="full-height-section d-md-none d-block">
      <div class="container-xxl h-100 d-flex flex-column justify-content-evenly">
        <div class="row">
          <div class="col-6 text-center">
            <img class="icons mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/house.svg')}}"
                 alt="House icon">
            <p>dzīvojamā platība</p>
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">101 - 180 m<sup>2</sup></h3>
          </div>
          <div class="col-6 text-center">
            <img class="icons mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/card.svg')}}"
                 alt="Card icon">
            <p>cena no</p>
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">249 000 EUR</h3>
          </div>
        </div>
        <div class="row mt-lg-5 mt-4">
          <div class="col-6 text-center">
            <img class="icons mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/bed.svg')}}"
                 alt="Bed icon">
            <p>guļamistabas</p>
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">3 - 4</h3>
          </div>
          <div class="col-6 text-center">
            <img class="icons mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/check.svg')}}"
                 alt="Checkmark icon">
            <p>energoefektivitāte</p>
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">A klase</h3>
          </div>
        </div>
        <div class="row mt-lg-5 mt-4">
          <div class="col-6 text-center">
            <img class="icons mb-lg-3 mb-2"
                 src="{{asset('storage/landing-pages/icons/map-pin-line.svg')}}"
                 alt="Map icon">
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">labiekārtota teritorija</h3>
          </div>
          <div class="col-6 text-center">
            <img class="icons mb-lg-3 mb-2" src="{{asset('storage/landing-pages/icons/key.svg')}}"
                 alt="Key icon">
            <div class="mx-auto text-center w-75">
              <hr class="m-1">
            </div>
            <h3 class="title fw-bold">līdz atslēgai</h3>
          </div>
        </div>
      </div>
    </section>
    {{--    Gallery--}}
    <section class="full-height-section">
      <div class="container-xxl h-100 d-flex align-items-center" id="landing-page-galleries">
        <div id="svires-ielas-projekts-gallery-main-carousel" class="splide">
          <div class="splide__track">
            <ul class="splide__list">
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/1.jpg') }}">
                  <img
                    data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/1.jpg') }}"
                    alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/2.jpg') }}">
                  <img
                    data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/2.jpg') }}"
                    alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/3.jpg') }}">
                  <img
                    data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/3.jpg') }}"
                    alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/4.jpg') }}">
                  <img
                    data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/4.jpg') }}"
                    alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/5.jpg') }}">
                  <img
                    data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/5.jpg') }}"
                    alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/6.jpg') }}">
                  <img
                    data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/6.jpg') }}"
                    alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/7.jpg') }}">
                  <img
                    data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/7.jpg') }}"
                    alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/8.jpg') }}">
                  <img
                    data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/8.jpg') }}"
                    alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/9.jpg') }}">
                  <img
                    data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/9.jpg') }}"
                    alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/10.jpg') }}">
                  <img
                    data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/galerija/10.jpg') }}"
                    alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    {{--    Explore neighbourhood--}}
    <section class="full-height-section d-flex flex-column">
      <div class="mb-4 pt-3">
        <h2 class="fw-bold title text-center">Iepazīsti apkaimi</h2>
      </div>
      <div class="h-100 mb-3">
        <iframe src="https://snazzymaps.com/embed/564387" class="map-size"></iframe>
      </div>
      <div class="container-xxl mb-5">
        <div class="row justify-content-evenly">
          <div class="col-lg-3 col-6 mb-lg-0 mb-3 text-center">
            <h3 class="title">1,8 km</h3>
            <p class="fw-bold">Pirmsskolas izglītības iestāde "Saulīte"</p>
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
            <h3 class="title">2,1 km</h3>
            <p class="fw-bold">pilsētas centrs</p>
          </div>
          <div>
            <hr class="m-3">
          </div>
          <a href="#contact-us"
             class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
          >Pieteikties konsultācijai</a>
        </div>
      </div>
    </section>
    {{--    Full screen image divider--}}
    <section class="full-height-section">
      <img class="full-container-image"
           src="{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/6.jpg')}}"
           alt="Svīres ielas projekts, Siguldā">
    </section>
    {{--    Full project house--}}
    <section class="full-height-section">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col-lg-5 d-flex flex-column justify-content-evenly">
            <div class="mb-2">
              <h2 class="fw-bold title">No pamatiem<br/>līdz atslēgai</h2>
            </div>
            <div>
              <p class="mb-2">Energoefektīva koka karkasa vienstāvīga ģimenes māja ar terasi, noliktavu un auto
                novietni
                divām automašīnām. Mājā ir plānotas trīs guļamistabas, plaša dzīvojamā telpa, kas ir apvienota ar
                virtuvi un augstajiem griestiem līdz jumta konstrukcijai, pārējā mājas daļā griestu augstums 2,70m.
                Pārējās telpas – vannas istaba un dušas telpa ar tualeti, kā arī tehniskā telpa.</p>
              <p class="mb-2"><strong>MĀJAI BŪS PILNĪBĀ PABEIGTI ĀRDARBI</strong><br/>
                Ārējā apdare, labiekārtota teritorija, uzstādīta sēta un automātiskie iebraucamie vārti.</p>
              <p class="mb-2"><strong>MĀJAI BŪS PILNĪBĀ PABEIGTI IEKŠDARBI</strong><br/>
                Krāsotas sienas, griesti, noflīzēti un aprīkoti sanmezgli, ieklāts grīdas segums, uzstādīta virtuves
                iekārta ar virtuves tehniku, masīvkoka iekšdurvis, iebūvējamie gaismekļi sanmezglos un gaitenī.</p>
              <p><strong>KOMUNIKĀCIJAS</strong><br/>
                Elektrība, santehnika, rekuperācijas iekārta, gaiss - ūdens siltumsūknis ar siltajām grīdām.</p>
            </div>
          </div>
          <div class="col-lg-7 d-lg-flex d-none flex-column justify-content-center">
            <img loading="lazy" class="full-container-image"
                 src="{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/7.jpg')}}"/>
          </div>
        </div>
      </div>
    </section>
    {{--    Full screen image divider--}}
    <section class="full-height-section">
      <img class="full-container-image"
           src="{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/8.jpg')}}"
           alt="Svīres ielas projekts, Siguldā">
    </section>
    {{--    Available projects (digital map)--}}
    <section id="available-projects" class="full-height-section d-flex flex-column">
      <div class="container-xxl h-100 mt-5 mb-3">
        <div class="h-100">
          <div id="available-projects-map"></div>
          @include('includes.available-project-modal')
        </div>
      </div>
      <div class="container-xxl mb-5">
        <div class="row justify-content-evenly">
          <div class="col-lg-3 col-6 mb-lg-0 mb-3 text-center">
            <h3 class="title">48</h3>
            <p class="fw-bold">zemes gabali</p>
          </div>
          <div class="col-lg-3 col-6 mb-lg-0 mb-3 text-center">
            <h3 class="title">26</h3>
            <p class="fw-bold">rezervēti</p>
          </div>
          <div class="col-lg-3 col-6 text-center">
            <h3 class="title">50 000 EUR</h3>
            <p class="fw-bold">1200 m<sup>2</sup> zemes gabala cena</p>
          </div>
          <div class="col-lg-3 col-6 text-center">
            <h3 class="title">30.08.2024.</h3>
            <p class="fw-bold">plānots pabeigt projekta infrastruktūru</p>
          </div>
          <div>
            <hr class="m-3">
          </div>
          <a href="#contact-us"
             class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
          >Pieteikties konsultācijai</a>
        </div>
      </div>
    </section>
    {{--    Reasons to live in Sigulda--}}
    <section class="full-height-section"
             style="background-image:url({{asset('storage/landing-pages/svires-ielas-projekts-sigulda/9.jpg')}})">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col-lg-6 col-12 p-4 col-with-background">
            <div class="mb-4">
              <h2 class="fw-bold title text-white">Kāpēc dzīvot Siguldā?</h2>
            </div>
            <ul class="p-0 m-0">
              <li class="d-flex justify-content-between">
                <div class="ml-3">
                  <img class="checkmark-icon-as-list-item"
                       src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="White checkmark icon">
                </div>
                <p class="text-white mb-3">Sigulda piedāvā mierīgu un drošu vidi, kas ir piemērota ģimenēm. Ainavas,
                  parki un daudzās pastaigu takas sniedz iespēju baudīt dabas skaistumu un tās piedāvāto relaksējošo
                  mieru.
                </p>
              </li>
              <li class="d-flex justify-content-between">
                <div class="mr-3">
                  <img class="checkmark-icon-as-list-item"
                       src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="White checkmark icon">
                </div>
                <p class="text-white mb-3">Labas izglītības iespējas - Sigulda piedāvā kvalitatīvas izglītības iestādes
                  -bērnudārzus, sporta, mākslas un mūzikas skolas, kas veicina bērnu attīstību un izaugsmi.
                </p>
              </li>
              <li class="d-flex justify-content-between">
                <div class="mr-3">
                  <img class="checkmark-icon-as-list-item"
                       src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="White checkmark icon">
                </div>
                <p class="text-white mb-3">Aktīvās atpūtas iespējas - pilsēta ir bagāta ar dažādām aktivitātēm un sporta
                  iespējām, kas ir piemērotas ikvienam! Sigulda veicina aktīvu un veselīgu dzīvesveidu.</p>
              </li>
              <li class="d-flex justify-content-between">
                <div class="mr-3">
                  <img class="checkmark-icon-as-list-item"
                       src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="White checkmark icon">
                </div>
                <p class="text-white">Kultūras un sabiedriskā dzīve - pilsēta regulāri rīko dažādus kultūras un
                  sabiedriskos pasākumus, piedāvājot ģimenēm iespēju piedalīties kopīgās aktivitātēs un veicināt
                  savstarpējo saikni ar pilsētas kopienas locekļiem.</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    {{--    CEO quot--}}
    <section id="ceo-quot" class="full-height-section">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col-lg-9 col-12 ceo-quot">
            <p class="quot-element">“</p>
            <div class="mx-4">
              <h3 class="fw-bold title text-uppercase mb-4">MĒS SEVI DEFINĒJĀM KĀ UZŅĒMUMU, KURA PAMATĀ IR
                PROFESIONĀLA
                RAŽOŠANAS UN MONTĀŽAS PIEEJA, UN MŪSU
                GALVENAIS MĒRĶIS IR RADĪT MĀJU SAJŪTU KOPĀ!</h3>
              <p class="text-uppercase">Helvijs Ervalds</p>
              <p class="text-uppercase">Modern House CEO</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    {{--    Why choose MH--}}
    <section id="quality-standards" class="full-height-section"
             style="background-image:url({{asset('storage/landing-pages/svires-ielas-projekts-sigulda/10.jpg')}})">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center position-relative">
        <div class="row">
          <div class="offset-lg-6 col-lg-6 col-12 p-4 col-with-background">
            <div class="mb-4">
              <h2 class="fw-bold title text-white">Kāpēc izvēlēties MODERN HOUSE?</h2>
            </div>
            <p class="text-white mb-4">
              MODERN HOUSE realize projektus, kuri veidoti ar kvalitāti, estētiku, komfortu un ilgtspējīgu.
              Strādājam tikai un vienīgi ar augstvērtīgiem materiāliem, kuru ražotāji piedāvā uzticamus un pārbaudītus
              risinājumus , cenšoties radīt izturīgas un ilgtspējīgas mājas. Mūsu prioritāte ir nodrošināt klientiem ne
              tikai vizuālu un funkcionālu baudu, bet arī ilgtermiņa vērtību, izmantojot visdrošākās tehnoloģijas mājas
              ilgtspējībai un energoefektivitātei. Mēs uzskatām, ka kvalitatīvs būvniecības process veicina gan mājas,
              gan apkārtējās vides labklājību.</p>
          </div>
        </div>
        <div class="row position-absolute">
          <a href="#technical-specification"
             class="btn btn-secondary fw-light d-flex justify-content-center align-items-center"
          >Tehniskā specifikācija</a>
        </div>
      </div>
    </section>
    {{--    Interior concept--}}
    <section class="full-height-section">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col-lg-5 d-flex flex-column justify-content-evenly">
            <div class="mb-4">
              <h2 class="fw-bold title">Interjera koncepts</h2>
            </div>
            <div>
              <p class="mb-4">MODERN HOUSE interjera dizains izceļas ar vienkāršumu, estētiku un dabīgo apgaismojumu,
                radot harmonisku un mājīgu vidi ikvienai mājai.
                Mēs pievēršam uzmanību minimālistiskiem un funkcionāliem dizaina elementiem, izmantojot dabīgus un
                ilgtspējīgus materiālus.</p>
              <p class="mb-4">Dizains tiek veidots, ņemot vērā klienta individuālās vēlmes ar iespēju pielāgot māju
                pēc saviem priekšstatiem. Piedāvājumā ietilpst dažādas opcijas un akcenti, lai klienti varētu
                personalizēt savu mājokli, pievienojot un mainot elementus pēc savām vēlmēm.</p>
              <p>Tādējādi mūsu dizains ir atbilst ne tikai uz modernajām tendencēm, bet arī sniedz elastīgus
                risinājumus, lai mūsu klienti varētu izpaust savu personīgo stilu un iecerēto dzīvesveidu savā jaunajā
                mājoklī.</p>
            </div>
          </div>
          <div class="col-lg-7 d-md-flex d-none flex-column justify-content-center mt-lg-0 mt-4"
               id="landing-page-galleries">
            <div id="interior-concept-gallery-main-carousel" class="splide">
              <div class="splide__track">
                <ul class="splide__list">
                  <li class="splide__slide">
                    <a data-fslightbox="interior-concept-gallery"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/1.jpg') }}">
                      <img
                        data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/1.jpg') }}"
                        alt="Interior concept for Modern House projects">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="interior-concept-gallery"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/2.jpg') }}">
                      <img
                        data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/2.jpg') }}"
                        alt="Interior concept for Modern House projects">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="interior-concept-gallery"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/3.jpg') }}">
                      <img
                        data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/3.jpg') }}"
                        alt="Interior concept for Modern House projects">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="interior-concept-gallery"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/4.jpg') }}">
                      <img
                        data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/4.jpg') }}"
                        alt="Interior concept for Modern House projects">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="interior-concept-gallery"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/5.jpg') }}">
                      <img
                        data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/5.jpg') }}"
                        alt="Interior concept for Modern House projects">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="interior-concept-gallery"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/6.jpg') }}">
                      <img
                        data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/6.jpg') }}"
                        alt="Interior concept for Modern House projects">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="interior-concept-gallery"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/7.jpg') }}">
                      <img
                        data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/7.jpg') }}"
                        alt="Interior concept for Modern House projects">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="interior-concept-gallery"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/8.jpg') }}">
                      <img
                        data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/8.jpg') }}"
                        alt="Interior concept for Modern House projects">
                    </a>
                  </li>
                  <li class="splide__slide">
                    <a data-fslightbox="interior-concept-gallery"
                       href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/9.jpg') }}">
                      <img
                        data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/9.jpg') }}"
                        alt="Interior concept for Modern House projects">
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    {{--    Interior concept gallery (mobile only)--}}
    <section class="full-height-section d-md-none d-block">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
        <div id="landing-page-galleries">
          <div id="interior-concept-mobile-gallery-main-carousel" class="splide">
            <div class="splide__track">
              <ul class="splide__list">
                <li class="splide__slide">
                  <a data-fslightbox="interior-concept-mobile-gallery"
                     href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/1.jpg') }}">
                    <img
                      data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/1.jpg') }}"
                      alt="Interior concept for Modern House projects">
                  </a>
                </li>
                <li class="splide__slide">
                  <a data-fslightbox="interior-concept-mobile-gallery"
                     href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/2.jpg') }}">
                    <img
                      data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/2.jpg') }}"
                      alt="Interior concept for Modern House projects">
                  </a>
                </li>
                <li class="splide__slide">
                  <a data-fslightbox="interior-concept-mobile-gallery"
                     href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/3.jpg') }}">
                    <img
                      data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/3.jpg') }}"
                      alt="Interior concept for Modern House projects">
                  </a>
                </li>
                <li class="splide__slide">
                  <a data-fslightbox="interior-concept-mobile-gallery"
                     href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/4.jpg') }}">
                    <img
                      data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/4.jpg') }}"
                      alt="Interior concept for Modern House projects">
                  </a>
                </li>
                <li class="splide__slide">
                  <a data-fslightbox="interior-concept-mobile-gallery"
                     href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/5.jpg') }}">
                    <img
                      data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/5.jpg') }}"
                      alt="Interior concept for Modern House projects">
                  </a>
                </li>
                <li class="splide__slide">
                  <a data-fslightbox="interior-concept-mobile-gallery"
                     href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/6.jpg') }}">
                    <img
                      data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/6.jpg') }}"
                      alt="Interior concept for Modern House projects">
                  </a>
                </li>
                <li class="splide__slide">
                  <a data-fslightbox="interior-concept-mobile-gallery"
                     href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/7.jpg') }}">
                    <img
                      data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/7.jpg') }}"
                      alt="Interior concept for Modern House projects">
                  </a>
                </li>
                <li class="splide__slide">
                  <a data-fslightbox="interior-concept-mobile-gallery"
                     href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/8.jpg') }}">
                    <img
                      data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/8.jpg') }}"
                      alt="Interior concept for Modern House projects">
                  </a>
                </li>
                <li class="splide__slide">
                  <a data-fslightbox="interior-concept-mobile-gallery"
                     href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/9.jpg') }}">
                    <img
                      data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/9.jpg') }}"
                      alt="Interior concept for Modern House projects">
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div id="non-scroll-type-sections">
      {{--      Technical specification--}}
      <section id="technical-specification">
        <div class="container-xxl">
          <div class="row">
            <div class="my-4 text-center">
              <h2 class="fw-bold title">Tehniskā specifikācija</h2>
            </div>
            <x-product-variant-option-buttons :productVariant="$productVariant"/>
            <x-product-variant-options :productVariant="$productVariant"/>
          </div>
        </div>
      </section>
      {{--      FAQ--}}
      <section class="mt-5">
        <div class="container-xxl">
          <div class="row">
            <div class="my-4 text-center">
              <h2 class="fw-bold title">Biežāk uzdotie jautājumi</h2>
            </div>
            <div class="tab-content product-variant-option mt-2">
              <div class="tab-pane fade show active">
                <div class="accordion accordion-flush">
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed variant-button" type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#{{Str::slug('Vai ir iespējams veikt izmaiņas māju projektos?')}}"
                              aria-expanded="false"
                              aria-controls="{{Str::slug('Vai ir iespējams veikt izmaiņas māju projektos?')}}">
                        Vai ir iespējams veikt izmaiņas māju projektos?
                      </button>
                    </h2>
                    <div id="{{Str::slug('Vai ir iespējams veikt izmaiņas māju projektos?')}}"
                         class="accordion-collapse collapse product-variant-option-content">
                      <div class="accordion-body">
                        Jā, projektus varam gan pielāgot Jūsu vēlmēm, gan izstrādāt ko pilnīgi individuālu.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed variant-button" type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#{{Str::slug('Vai piedāvājat arī būvatļaujas saskaņošanu')}}"
                              aria-expanded="false"
                              aria-controls="{{Str::slug('Vai piedāvājat arī būvatļaujas saskaņošanu')}}">
                        Vai piedāvājat arī būvatļaujas saskaņošanu?
                      </button>
                    </h2>
                    <div id="{{Str::slug('Vai piedāvājat arī būvatļaujas saskaņošanu')}}"
                         class="accordion-collapse collapse product-variant-option-content">
                      <div class="accordion-body">
                        Jā, pēc atsevišķas vienošanās varam veikt visas dokumentācijas lietas sākot ar būvatļaujas
                        saskaņošanu, līdz ēkas nodošanai ekspluatācijā.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed variant-button" type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#{{Str::slug('Vai izvēloties māju pilnajā komplektācijā mums būs iespēja veikt izmaiņas apdares materiālos un interjera izvēlēs')}}"
                              aria-expanded="false"
                              aria-controls="{{Str::slug('Vai izvēloties māju pilnajā komplektācijā mums būs iespēja veikt izmaiņas apdares materiālos un interjera izvēlēs')}}">
                        Vai izvēloties māju pilnajā komplektācijā mums būs iespēja veikt izmaiņas apdares materiālos un
                        interjera izvēlēs?
                      </button>
                    </h2>
                    <div
                      id="{{Str::slug('Vai izvēloties māju pilnajā komplektācijā mums būs iespēja veikt izmaiņas apdares materiālos un interjera izvēlēs')}}"
                      class="accordion-collapse collapse product-variant-option-content">
                      <div class="accordion-body">
                        Jā, Jums būs iespēja pilnībā pielāgot mājas interjeru savām vēlmēm. Darba kārtībā saskaņosim ar
                        Jums visus iekšdarbu dizainu un materiālus. Tādas lietas kā flīzes, grīdas segumu, elektro
                        iekārtas, vannas istabu aprīkojumu varēsiet izvēlēties no mūsu piedāvājuma vai mūsu sadarbības
                        partneriem vai arī no kāda Jūsu izvēlēta piegādātāja.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed variant-button" type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#{{Str::slug('Kas ietilpst mājas komplektācijā')}}"
                              aria-expanded="false"
                              aria-controls="{{Str::slug('Kas ietilpst mājas komplektācijā')}}">
                        Kas ietilpst mājas komplektācijā?
                      </button>
                    </h2>
                    <div id="{{Str::slug('Kas ietilpst mājas komplektācijā')}}"
                         class="accordion-collapse collapse product-variant-option-content">
                      <div class="accordion-body">
                        Ar mājas tehnisko specifikāciju un iekļauto lietu raksturojumu iespējams iepazīties mūsu
                        mājaslapā zem katra attiecīgā produkta, izvēloties attiecīgo komplektāciju.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed variant-button" type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#{{Str::slug('Vai ir iespējams apskatīt arī kādu gatavu produktu')}}"
                              aria-expanded="false"
                              aria-controls="{{Str::slug('Vai ir iespējams apskatīt arī kādu gatavu produktu')}}">
                        Vai ir iespējams apskatīt arī kādu gatavu produktu?
                      </button>
                    </h2>
                    <div id="{{Str::slug('Vai ir iespējams apskatīt arī kādu gatavu produktu')}}"
                         class="accordion-collapse collapse product-variant-option-content">
                      <div class="accordion-body">
                        Iepriekš saskaņojot varam vienoties par apskati kādā mūsu jau pabeigtā projektā un vienmēr esam
                        atvērti Jums izrādīt arī kādu vēl būvniecības stadijā esošu projektu, kas ir ļoti laba iespēja
                        apskatīt no kā māja sastāv. Pie mums ražotnē Siguldā, Lauku ielā 1 ir apskatāmas arī demo moduļu
                        mājas un ar lielāko prieku arī parādīsim un pastāstīsim par pašu ražošanas procesu.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed variant-button" type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#{{Str::slug('Ar kādu termiņu man ir jārēķinās pasūtot no Jums māju')}}"
                              aria-expanded="false"
                              aria-controls="{{Str::slug('Ar kādu termiņu man ir jārēķinās pasūtot no Jums māju')}}">
                        Ar kādu termiņu man ir jārēķinās pasūtot no Jums māju?
                      </button>
                    </h2>
                    <div id="{{Str::slug('Ar kādu termiņu man ir jārēķinās pasūtot no Jums māju')}}"
                         class="accordion-collapse collapse product-variant-option-content">
                      <div class="accordion-body">
                        Ja izvēlaties kādu no mūsu tipveida piedāvājumā esošu produktu, izpildes termiņš moduļu mājai
                        būtu 10 – 14 nedēļas, attiecīgi veicot izmaiņas vai pasūtot individuāli izstrādātu projektu, šis
                        termiņš var nedaudz pieaugt. Privātmājām darbu izpildes
                        termiņš no būvatļaujas saņemšanas un darbu uzsākšanas objektā līdz pabeigtai mājai ir 4 – 6
                        mēneši atkarībā no izvēlētā projekta.
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed variant-button" type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#{{Str::slug('Kāda ir apmaksas kārtība')}}"
                              aria-expanded="false"
                              aria-controls="{{Str::slug('Kāda ir apmaksas kārtība')}}">
                        Kāda ir apmaksas kārtība?
                      </button>
                    </h2>
                    <div id="{{Str::slug('Kāda ir apmaksas kārtība')}}"
                         class="accordion-collapse collapse product-variant-option-content">
                      <div class="accordion-body">
                        Moduļu mājām apmaksas kārtība ir sekojoša:<br/>
                        10% no līguma summas – pie līguma parakstīšanas;<br/>
                        40% no līguma summas – pirms moduļu mājas ražošanas darbu uzsākšanas;<br/>
                        30% no līguma summa – pirms iekšējo apdares darbu uzsākšanas;<br/>
                        10% no līguma summas – pēc pieņemšanas/nodošanas akta parakstīšanas.<br/>
                        Privātmājām apmaksas kārtība tiek saskaņota pirms līguma slēgšanas, atkarībā no veicamo darbu
                        apjoma un pasūtītāja finansējuma veida.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      {{--      Contact us--}}
      <section id="contact-us" class="mt-5">
        <div class="container-xxl position-relative">
          <div class="row">
            <div class="mb-4 text-center">
              <h2 class="fw-bold title">Piepildi sapni, piesakies konsultācijai!</h2>
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column">
              <x-contact-us-form :formId="'Forma - Svīres ielas projekts, Siguldā'"
                                 :hideCompanyField="true"
                                 :subject="'Jauna ziņa no mājaslapas (Svīres ielas projekta sadaļas)'"/>
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-between flex-column mt-lg-0 mt-4">
              <x-staff/>
            </div>
          </div>
        </div>
      </section>
      {{--Footer--}}
      {{--      TODO: On safari jump to the section when reached the bottom--}}
      <section class="mt-5">
        @include('includes.footer')
      </section>
    </div>
  </div>
  <script type="module">
    const landingPageGalleryImages = document.querySelectorAll('#landing-page-galleries');
    landingPageGalleryImages.forEach((image) => {
      const main = new Splide('#' + image.firstElementChild.id, {
        type: 'fade',
        pagination: true,
        lazyLoad: 'nearby',
      });
      main.mount();
    });

    const modal = document.getElementById('available-project-modal');
    const modalContents = document.querySelectorAll('.available-projects-content > div');
    const mapImageUrl = '{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/map.jpg')}}';
    const map = L.map('available-projects-map', {
      crs: L.CRS.Simple,
      maxZoom: 1,
      minZoom: -1,
      scrollWheelZoom: false,
      zoomControl: false
    });

    L.control.zoom({
      position: 'bottomright'
    }).addTo(map);

    const bounds = [[0, 0], [600, 1320]];
    const image = L.imageOverlay(mapImageUrl, bounds).addTo(map);
    const mapMarker = L.divIcon({
      className: 'map-marker', // Your custom CSS class
      html: '<div></div>',
    });

    map.fitBounds(bounds);
    map.setMaxBounds(bounds);
    map.setView([300, 660], 0);

    setTimeout(function () {
      window.dispatchEvent(new Event("resize"));
    }, 500);

    const markersData = [
      {
        coords: [525, 150],
        title: "Pieejams projekts Svīres iela 1",
        contentId: 'available-project-content'
      },
      {
        coords: [525, 275],
        title: "Pieejams projekts Svīres iela 3",
        contentId: 'available-project-content'
      },
      {
        coords: [525, 475],
        title: "Pieejams projekts Svīres iela 7",
        contentId: 'available-project-content'
      },
      {
        coords: [525, 575],
        title: "Pieejams projekts Svīres iela 9",
        contentId: 'available-project-content'
      },
      {
        coords: [525, 675],
        title: "Pieejams projekts Svīres iela 11",
        contentId: 'available-project-content'
      },
      {
        coords: [525, 925],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [400, 175],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [390, 385],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [390, 475],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [390, 570],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [390, 750],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [430, 1175],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [300, 200],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [250, 385],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [250, 570],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [250, 750],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [330, 1175],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [95, 500],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [95, 580],
        title: "Pieejams zemes gabals un projekts pēc individuāla pieprasījuma",
        contentId: 'available-project-land-content'
      },
      {
        coords: [325, 655],
        title: "Parks un bērnu laukums",
        contentId: 'available-project-asset-content'
      },
      {
        coords: [100, 150],
        title: "Prettrokšņu valnis",
        contentId: 'available-project-asset-content'
      },
    ];
    markersData.forEach(({coords, title, contentId}) => {
      const marker = L.marker(coords, {title: title, icon: mapMarker}).addTo(map);

      marker.on('click', function () {
        const modalContent = document.getElementById(contentId);
        modalContent.firstElementChild.textContent = title;
        const bootstrapModal = new bootstrap.Modal(modal);

        bootstrapModal.show();
        modalContent.classList.remove('visually-hidden');
      });
    });

    modal.addEventListener('hidden.bs.modal', () => {
      modalContents.forEach((content) => {
        content.classList.add('visually-hidden');
      });
    });
  </script>
@endsection

