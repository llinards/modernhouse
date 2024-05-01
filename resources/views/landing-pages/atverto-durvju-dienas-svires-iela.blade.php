@extends('layouts.landing-page-app', ['title' => 'Atvērto durvju dienas Svīres ielā, Siguldā'])
@section('content')
  <div id="landing-page" class="position-relative">
    {{--    Introduction--}}
    <section id="introduction" class="full-height-section d-flex flex-column justify-content-between"
             style="background-image:url('{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/introduction.jpg')}}');">
      <h1 class="text-center text-white text-uppercase">Modern House<br/>atvērto durvju dienas</h1>
      <div class="text-center d-flex flex-column align-items-center">
        <div class="d-flex justify-content-center align-items-center flex-wrap">
          <div class="d-flex mb-3 mb-sm-4 mx-4">
            <img class="icon" src="{{asset('storage/icons/calendar-check-white.svg')}}" alt="Calendar icon">
            <p class="text-white fw-bold">1. un 2. jūlijs</p>
          </div>
          <div class="d-flex mb-3 mb-sm-4 mx-4">
            <img class="icon" src="{{asset('storage/icons/clock-white.svg')}}" alt="Clock icon">
            <p class="text-white fw-bold">10:00 - 19:00</p>
          </div>
          <div class="d-flex mb-3 mb-sm-4 mx-4">
            <img class="icon" src="{{asset('storage/landing-pages/icons/map.svg')}}" alt="Location icon">
            <p class="text-white fw-bold">Svīres iela, Sigulda</p>
          </div>
        </div>
        <div>
          <a href="#contact-us"
             class="btn btn-secondary d-flex justify-content-center align-items-center"
          >Pieteikties</a>
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
          <div class="col-lg-6 col-ofs d-flex flex-column justify-content-evenly">
            <h2 class="mb-4">Par atvērtajām durvju dienām</h2>
            <div>
              <p class="mb-2">MODERN HOUSE komanda aicina uz atvērtajām durvju dienām Siguldā, Svīres ielas projektā.
                Šis būs piedzīvojums caur māju būvniecības procesu. Pasākuma dienās pastāstīsim par būvniecības stadijā
                esošajām privātmājām, kā arī pilnībā pabeigtu Demo māju. Tāpat pasākuma laikā būs iespēja uzdot arī
                tehniskus jautājumus, jo tajā piedalīsies projektu vadītāji, citi speciālisti no MODERN HOUSE komandas.
                Mājokļa tirgus situācijas analīzei un tendenču apskatam pasākumā piedalīsies arī banku pārstāvji SEB un
                Swedbank. Būs iespēja iepazīties ar citu projektu māju klientiem.</p>
              <p class="mb-2">
                Svīres ielas projekta būvniecība rit pilnā sparā, un iedzīvotāji savās jaunajās mājas varēs ievākties
                jau šī gada rudenī. Projektu veido A klases energoefektivitātes 5 privātmājas. Projektā kopā būs
                pieejami 53 apbūves gabali.</p>
              <p class="mb-2">Atnāciet un iepazīstaties ar mūsu darba procesu (kā mēs to darām) un jaunāko projektu
                Siguldā!
                Atveram durvis Jūsu sapņu mājai kopā!</p>
            </div>
          </div>
          <div class="col-lg-4 offset-lg-2 d-md-flex d-none flex-column justify-content-center mt-lg-0 mt-3">
            <div class="row">
              <div class="col-12 d-flex justify-content-lg-start justify-content-center">
                <img class="icons open-days-icons" src="{{asset('storage/icons/calendar-check.svg')}}"
                     alt="Calendar icon">
                <h3>1. un 2. jūlijs</h3>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-12 d-flex justify-content-lg-start justify-content-center">
                <img class="icons open-days-icons" src="{{asset('storage/icons/clock.svg')}}"
                     alt="Clock icon">
                <h3>10:00 - 19:00</h3>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-12 d-flex justify-content-lg-start justify-content-center">
                <img class="icons open-days-icons"
                     src="{{asset('storage/icons/map-pin-line-3.svg')}}"
                     alt="Location icon">
                <h3>Svīres iela, Sigulda</h3>
              </div>
            </div>
            <div class="mt-4 d-flex justify-content-lg-start justify-content-center">
              <a href="#contact-us"
                 class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
              >Pieteikties</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    {{--    About project (mobile only)--}}
    <section class="full-height-section d-md-none d-block">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
        <div class="mx-auto">
          <div class="d-flex align-items-center">
            <img class="icons open-days-icons" src="{{asset('storage/icons/calendar-check.svg')}}"
                 alt="Calendar icon">
            <h3>1. un 2. jūlijs</h3>
          </div>
          <div class="d-flex align-items-center mt-2">
            <img class="icons open-days-icons" src="{{asset('storage/icons/clock.svg')}}"
                 alt="Clock icon">
            <h3>10:00 - 19:00</h3>
          </div>
          <div class="d-flex align-items-center mt-2">
            <img class="icons open-days-icons"
                 src="{{asset('storage/icons/map-pin-line-3.svg')}}"
                 alt="Location icon">
            <h3>Svīres iela, Sigulda</h3>
          </div>
        </div>
        <div class="mt-4 align-self-center">
          <div class="d-flex">
            <a href="#contact-us"
               class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
            >Pieteikties</a>
          </div>
        </div>
      </div>
    </section>
    {{--    Partnership--}}
    <section class="full-height-section">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
        <div class="row mb-4">
          <h2 class="mb-4 text-center">Finansētāji</h2>
          <div class="col-lg-12 d-flex flex-column justify-content-evenly">
            <div class="row financiers-logo">
              <div class="col-6 text-center">
                <img class="swedbank-logo mb-2" src="{{asset('storage/icons/swedbank-logo.svg')}}"
                     alt="Swedbank logo">
              </div>
              <div class="col-6 text-center">
                <img class="seb-logo mb-2" src="{{asset('storage/icons/seb-logo.jpg')}}"
                     alt="SEB logo">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <h2 class="mb-4 text-center">Sadarbībā ar</h2>
          <div class="col-lg-12 d-flex flex-column justify-content-evenly">
            <div class="row mb-4 partnership-logo">
              <div class="col-6 col-md-3 text-center">
                <img class="mb-2" src="{{asset('storage/logo/logo-black.png')}}"
                     alt="">
              </div>
              <div class="col-6 col-md-3 text-center">
                <img class="mb-2" src="{{asset('storage/logo/logo-black.png')}}"
                     alt="">
              </div>
              <div class="col-6 col-md-3 text-center">
                <img class="mb-2" src="{{asset('storage/logo/logo-black.png')}}"
                     alt="">
              </div>
              <div class="col-6 col-md-3 text-center">
                <img class="mb-2" src="{{asset('storage/logo/logo-black.png')}}"
                     alt="">
              </div>
            </div>
            <div class="row partnership-logo">
              <div class="col-6 col-md-3 text-center">
                <img class="mb-2" src="{{asset('storage/logo/logo-black.png')}}"
                     alt="">
              </div>
              <div class="col-6 col-md-3 text-center">
                <img class="mb-2" src="{{asset('storage/logo/logo-black.png')}}"
                     alt="">
              </div>
              <div class="col-6 col-md-3 text-center">
                <img class="mb-2" src="{{asset('storage/logo/logo-black.png')}}"
                     alt="">
              </div>
              <div class="col-6 col-md-3 text-center">
                <img class="mb-2" src="{{asset('storage/logo/logo-black.png')}}"
                     alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    {{--    Explore neighbourhood--}}
    <section id="map" class="full-height-section d-flex flex-column justify-content-center">
      <div class="h-75">
        <iframe src="https://snazzymaps.com/embed/564387" class="map-size"></iframe>
      </div>
      <div class="d-flex flex-wrap justify-content-center mt-4 gap-2">
        <a href="https://www.waze.com/en/live-map/directions?to=ll.57.14237745%2C24.87469912"
           class="btn btn-primary d-flex justify-content-center align-items-center"
        >Waze</a>
        <a href="https://maps.app.goo.gl/te6FfLaa14RT6syJ8" target="_blank"
           class="btn btn-primary d-flex justify-content-center align-items-center"
        >Google Maps</a>
      </div>
    </section>
    {{--    Full project house--}}
    <section class="full-height-section">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col-lg-5 d-flex flex-column justify-content-evenly">
            <h2 class="mb-2">Atvērto durvju dienu programma</h2>
            <ul class="open-days-agenda">
              <li class="mb-2">Sarunas ar MODERN HOUSE komandu</li>
              <li class="mb-2">Sarunas ar arhitektu,inženieri, projektu vadītāju, pārdošanas vadītāju</li>
              <li class="mb-2">Sarunas ar SEB un Swedbank pārstāvjiem</li>
              <li class="mb-2">Sarunas ar MODERN HOUSE klientiem</li>
              <li class="mb-2">Sarunas ar sadarbības partneriem</li>
              <li>Iespēja noslēgt līgumu par labāku cenu</li>
            </ul>
          </div>
          <div class="col-lg-7 d-lg-flex d-none flex-column justify-content-center">
            <img loading="lazy" class="full-container-image"
                 src="{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/7.jpg')}}"/>
          </div>
        </div>
      </div>
    </section>
    <div id="non-scroll-type-sections">
      {{--      Contact us--}}
      <section id="contact-us">
        <div class="container-xxl position-relative">
          <livewire:open-days-registration-form :isBackButtonVisible="false"/>
        </div>
      </section>
      {{--Footer--}}
      {{--      TODO: On safari jump to the section when reached the bottom--}}
      <section class="mt-5">
        @include('includes.footer')
      </section>
    </div>
    <div id="button-up" class="position-fixed visually-hidden d-flex justify-content-center align-items-center">
      <a href="#introduction" class="d-flex justify-content-center align-items-center">
        <img width="20" height="20" src="{{ asset('storage/icons/arrow-down.svg') }}" alt="Arrow down">
      </a>
    </div>
  </div>
  <script type="module">
    const buttonUp = document.getElementById('button-up');

    document.getElementById('landing-page').onscroll = () => {
      buttonUp.classList.remove('visually-hidden');
    }

    buttonUp.addEventListener('click', () => {
      setTimeout(() => {
        buttonUp.classList.add('visually-hidden');
      }, 1500);
    });

    document.getElementById('apply-consultation-swedbank').addEventListener('click', () => {
      trackFormSubmit('apply_consultation_swedbank');
    });

    setTimeout(function () {
      window.dispatchEvent(new Event("resize"));
    }, 500);
  </script>
@endsection

