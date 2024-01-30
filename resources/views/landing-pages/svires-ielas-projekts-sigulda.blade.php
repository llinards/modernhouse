@extends('app', ['index' => null, 'title' => 'Svīres ielas projekts, Siguldā'])
@section('content')
  <div id="landing-page">
    <section id="introduction" class="full-height-section d-flex flex-column justify-content-between"
             style="background-image:url('{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/introduction.jpg')}}');">
      <h1 class="fw-bold text-center title">Piepildi sapni par <br/>māju Siguldā!</h1>
      <div class="text-center d-flex flex-column align-items-center position-relative">
        <div class="">
          <div class="d-flex justify-content-center align-items-center mb-lg-0 mb-3 location">
            <img class="location-icon" src="{{asset('storage/landing-pages/icons/map.svg')}}" alt="">
            <p class="ml-3 text-white fw-bold">Svīres ielas projekts</p>
          </div>
          <div class="">
            <a href="#contact-us"
               class="btn btn-secondary fw-light d-flex justify-content-center align-items-center"
            >Pieteikties konsultācijai</a>
          </div>
        </div>
        <a href="#about-project"
           class="pb-lg-5 pb-4 pt-3">
          <img width="35" height="35" src="{{ asset('storage/icons/arrow-down.svg') }}" alt="Arrow down">
        </a>
      </div>
    </section>
    <section id="about-project" class="full-height-section">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
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
      <div class="container-xxl h-100 d-flex flex-column justify-content-evenly">
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
    <section id="gallery" class="full-height-section">
      <div class="container-xxl h-100 d-flex align-items-center" id="landing-page-galleries">
        <div id="svires-ielas-projekts-gallery-main-carousel" class="splide">
          <div class="splide__track">
            <ul class="splide__list">
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/1.jpg') }}">
                  <img class=""
                       data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/1.jpg') }}"
                       alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/2.jpg') }}">
                  <img class=""
                       data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/2.jpg') }}"
                       alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/3.jpg') }}">
                  <img class=""
                       data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/3.jpg') }}"
                       alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/4.jpg') }}">
                  <img class=""
                       data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/4.jpg') }}"
                       alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
              <li class="splide__slide">
                <a data-fslightbox="svires-ielas-projekts"
                   href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/5.jpg') }}">
                  <img class=""
                       data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/5.jpg') }}"
                       alt="Svires ielas projekts, Siguldā">
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
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
          >Pieteikties konsultācijai</a>
        </div>
      </div>
    </section>
    <section id="full-project" class="full-height-section">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
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
            <img src="{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/7.jpg')}}"/>
          </div>
        </div>
      </div>
    </section>
    <section class="full-height-section">
      <img class="full-size-image-background"
           src="{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/8.jpg')}}"
           alt="">
    </section>
    <section id="available-projects" class="full-height-section d-flex flex-column">
      <div class="h-75 mt-lg-3 mt-0 mb-3 overflow-x-scroll">
        <img class="map" src="{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/map.jpg')}}" alt="">
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
            <p class="fw-bold">zemes gabala cena</p>
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
    <section id="live-in-sigulda" class="full-height-section"
             style="background-image:url({{asset('storage/landing-pages/svires-ielas-projekts-sigulda/9.jpg')}})">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center">
        <div class="row">
          <div class="col-lg-6 col-12 p-4">
            <h2 class="fw-bold title text-white mb-4">Kāpēc dzīvot Siguldā?</h2>
            <ul class="p-0 m-0">
              <li class="d-flex justify-content-between">
                <div class="ml-3">
                  <img src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="">
                </div>
                <p class="text-white mb-3">Sigulda piedāvā mierīgu un drošu vidi, kas ir piemērota ģimenēm. Ainavas,
                  parki un daudzās pastaigu takas sniedz iespēju baudīt dabas skaistumu un tās piedāvāto relaksējošo
                  mieru.
                </p>
              </li>
              <li class="d-flex justify-content-between">
                <div class="mr-3">
                  <img src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="">
                </div>
                <p class="text-white mb-3">Labas izglītības iespējas - Sigulda piedāvā kvalitatīvas izglītības iestādes
                  -bērnudārzus, sporta, mākslas un mūzikas skolas, kas veicina bērnu attīstību un izaugsmi.
                </p>
              </li>
              <li class="d-flex justify-content-between">
                <div class="mr-3">
                  <img src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="">
                </div>
                <p class="text-white mb-3">Aktīvās atpūtas iespējas - pilsēta ir bagāta ar dažādām aktivitātēm un sporta
                  iespējām, kas ir piemērotas ikvienam! Sigulda veicina aktīvu un veselīgu dzīvesveidu.</p>
              </li>
              <li class="d-flex justify-content-between">
                <div class="mr-3">
                  <img src="{{asset('storage/landing-pages/icons/check-white.svg')}}" alt="">
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
              <p class="text-uppercase fw-bold">Helvijs Ervalds</p>
              <p class="text-uppercase">Modern House CEO</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="quality-standards" class="full-height-section"
             style="background-image:url({{asset('storage/landing-pages/svires-ielas-projekts-sigulda/10.jpg')}})">
      <div class="container-xxl h-100 d-flex flex-column justify-content-center position-relative">
        <div class="row">
          <div class="offset-lg-6 col-lg-6 col-12 p-4">
            <h2 class="fw-bold title text-white mb-4">Kāpēc izvēlēties MODERN HOUSE?</h2>
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
             class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
          >Tehniskā specifikācija</a>
        </div>
      </div>
    </section>
    <div id="non-scroll-type-sections">
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
      <section id="interior-concept" class="mt-5">
        <div class="container-xxl d-flex flex-column justify-content-center">
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
            <div class="col-lg-7 d-flex flex-column justify-content-center mt-lg-0 mt-4" id="landing-page-galleries">
              <div id="interior-concept-gallery-main-carousel" class="splide">
                <div class="splide__track">
                  <ul class="splide__list">
                    <li class="splide__slide">
                      <a data-fslightbox="interior-concept-gallery"
                         href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/1.jpg') }}">
                        <img class=""
                             data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/1.jpg') }}"
                             alt="Svires ielas projekts, Siguldā">
                      </a>
                    </li>
                    <li class="splide__slide">
                      <a data-fslightbox="interior-concept-gallery"
                         href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/2.jpg') }}">
                        <img class=""
                             data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/2.jpg') }}"
                             alt="Svires ielas projekts, Siguldā">
                      </a>
                    </li>
                    <li class="splide__slide">
                      <a data-fslightbox="interior-concept-gallery"
                         href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/3.jpg') }}">
                        <img class=""
                             data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/3.jpg') }}"
                             alt="Svires ielas projekts, Siguldā">
                      </a>
                    </li>
                    <li class="splide__slide">
                      <a data-fslightbox="interior-concept-gallery"
                         href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/4.jpg') }}">
                        <img class=""
                             data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/4.jpg') }}"
                             alt="Svires ielas projekts, Siguldā">
                      </a>
                    </li>
                    <li class="splide__slide">
                      <a data-fslightbox="interior-concept-gallery"
                         href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/5.jpg') }}">
                        <img class=""
                             data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/5.jpg') }}"
                             alt="Svires ielas projekts, Siguldā">
                      </a>
                    </li>
                    <li class="splide__slide">
                      <a data-fslightbox="interior-concept-gallery"
                         href="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/6.jpg') }}">
                        <img class=""
                             data-splide-lazy="{{ asset('storage/landing-pages/svires-ielas-projekts-sigulda/interjera-koncepts/6.jpg') }}"
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
      <section id="faq" class="mt-5">
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
                        Jums visus iekšdarbu materiālus un krāsas. Tādas lietas kā flīzes, grīdas segumu, elektro
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
                        apskatīt no kā māja sastāv.
                        Pie mums ražotnē Siguldā, Lauku ielā 1 ir apskatāmas arī Demo moduļu mājas un ar lielāko prieku
                        arī parādīsim un pastāstīsim par pašu ražošanas procesu.
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
                        Ja izvēlaties kādu mūsu piedāvājumā esošu produktu, izpildes termiņš moduļu mājai būtu 10 – 12
                        nedēļas, attiecīgi veicot izmaiņas vai pasūtot individuāli izstrādātu projektu, šis termiņš var
                        nedaudz pieaugt.
                        Privātmājām darbu izpildes termiņš no būvatļaujas saņemšanas un darbu uzsākšanas objektā līdz
                        pabeigtai mājai ir 4 – 5 mēneši atkarībā no mājas lieluma.
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
      <section id="contact-us" class="mt-5">
        <div class="container-xxl position-relative">
          <div class="row">
            <div class="mb-4 text-center">
              <h2 class="fw-bold title">Piepildi sapni, piesakies konsultācijai!</h2>
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column">
              <x-contact-us-form :subject="'Jauna ziņa no mājaslapas (Svīres ielas projekta sadaļas)'"/>
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-between flex-column mt-lg-0 mt-4">
              <x-staff/>
            </div>
          </div>
        </div>
      </section>
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
        heightRatio: 0.5,
      });
      main.mount();
    });
  </script>
@endsection

