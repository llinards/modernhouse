@extends('app', ['title' => Lang::get('about'), 'index' => false, 'allProducts' => $allProducts])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('about')</h1>
      <div class="mt-4">
        <div class="row">
          <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column">
            <img class="img-fluid" src="{{ asset('storage/about-us/one.jpg') }}" />
          </div>
          <div class="col-lg-6 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-4">
            <h2 class="fw-bold title mb-2">Mūsu vīzija</h2>
            <p>MODERN HOUSE realizē projektus, kuri ir veidoti ar kvalitāti, estētiku, komfortu un ilgtspējību.
              Projektos izvēlamies strādāt tikai ar labākajiem materiāliem un tieši tāpēc mēs arī vēlamies piesaistīt klientus, kuriem ir svarīga kvalitāte.
              Mēs radām ilgtspējīgu un mūsdienīgu koka karkasu māju konceptu.
            </p>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-lg-6 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-4">
            <h2 class="fw-bold title mb-2">Mūsu komanda</h2>
            <p>Mūsu komandā ir pārliecinoši cilvēki un savas jomas profesionāļi, kuri izvēlēsies labākos risinājumus un materiālus. Kontrolējam kvalitāti katrā celtniecības posmā un tieši tāpēc nodrošinām katram klientam iespēju iepazīties ar ražošanas procesu tepat Siguldā, kā arī iespēju redzēt Jūsu iecerētās sapņu mājas būvniecības procesu.
            </p>
          </div>
          <div class="col-lg-6 d-flex order-first order-lg-last justify-content-center align-items-center flex-column">
            <img class="img-fluid" src="{{ asset('storage/about-us/two.jpg') }}" />
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column">
            <img class="img-fluid" src="{{ asset('storage/about-us/three.jpg') }}" />
          </div>
          <div class="col-lg-6 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-4">
            <h2 class="fw-bold title mb-2">Interjera koncepts</h2>
            <p>MODERN HOUSE Interjera dizaina pamatā ir funkcionalitāte, vienkāršība un estētika.
              Kopējais mājokļa iekārtojums ir elegants un mūsdienīgs, kas rada patīkamu un ļoti mājīgu atmosfēru.
            </p>
              <p>Mūsu dizainam raksturīgs ir dabiskums, kas iekļauj koksni un dabīgu gaismu. Tieši tāpēc mūsu mājas ir ar lieliem logiem, kas visas dienas garumā nodrošina labu apgaismojumu.
            </p>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-lg-6 d-flex justify-content-center align-items-start flex-column ceo-quot">
            <h5 class="fw-bold mb-2">„Mēs sevi definējām kā uzņēmumu, kura pamatā ir profesionāla ražošanas un montāžas pieeja.”</h5>
            <p>Helvijs Ervalds</p>
            <p>Modern House CEO</p>
          </div>
          <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column mt-lg-0 mt-4">
            <img class="img-fluid" src="{{ asset('storage/about-us/four.jpg') }}" />
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('includes.footer')
@endsection
