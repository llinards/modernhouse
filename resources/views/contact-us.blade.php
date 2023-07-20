@extends('app', ['title' => Lang::get('contact'), 'index' => false, 'allProducts' => $allProducts])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('contact')</h1>
      @include('includes.status-messages')
      <div class="mt-4">
        <div class="row">
          <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column mt-lg-0 mt-4">
            <form method="POST" class="w-100" action="/{{app()->getLocale()}}/contact-us">
              @csrf
              <x-honeypot/>
              <div class="mb-3">
                <label for="name-surname" class="form-label fw-bold">Vārds, uzvārds*</label>
                <input type="text" name="name-surname" class="form-control" id="name-surname"
                       value="{{ old('name-surname') }}">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label fw-bold">E-pasts*</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
              </div>
              <div class="mb-3">
                <label for="phone-number" class="form-label fw-bold">Kontakttālrunis*</label>
                <input type="tel" name="phone-number" class="form-control" id="phone-number"
                       value="{{ old('phone-number') }}">
              </div>
              <div class="mb-3">
                <label for="company" class="form-label fw-bold">Uzņēmums</label>
                <input type="text" name="company" class="form-control" id="company" value="{{ old('company') }}">
              </div>
              <label for="customers-question" class="form-label fw-bold">Jautājumi</label>
              <textarea class="form-control mb-3" name="customers-question" id="customers-question" rows="3">
                {{ old('customers-question') }}
              </textarea>
              <div class="mb-3 d-flex align-items-center">
                <input class="form-check-input m-0" type="checkbox" value="1" checked
                       id="customer-agrees-for-data-processing"
                       name="customer-agrees-for-data-processing"
                >
                <label for="customer-agrees-for-data-processing" class="form-label mb-0 d-block mx-2">Piekrītu, ka mani
                  iesniegtie
                  dati tiek apstrādāti un uzglabāti.</label>
              </div>
              <div class="d-flex justify-content-center">
                <button type="submit" id="submit-contact-us"
                        class="mt-4 btn btn-primary disabled fw-light d-flex justify-content-center align-items-center text-uppercase">
                  Nosūtīt
                </button>
              </div>
            </form>
          </div>
          <div class="col-lg-6 order-first order-lg-last d-flex justify-content-center align-items-between flex-column">
            <div class="row modern-house-staff">
              <div class="col-6 text-center">
                <h5 class="fw-bold pb-1">Helvijs Ervalds</h5>
                <p>Modern House CEO</p>
                <a class="nav-link" href="mailto:helvijs@modern-house.lv">helvijs@modern-house.lv</a>
                <p>+371 25666622</p>
              </div>
              <div class="col-6 text-center">
                <h5 class="fw-bold pb-1">Aigars Jonass</h5>
                <p>Pārdošanas speciālists</p>
                <a class="nav-link" href="mailto:aigars@modern-house.lv">aigars@modern-house.lv</a>
                <p>+371 26312075</p>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-12 text-center">
                <i class="bi bi-geo-alt fs-2"></i>
                <h5 class="fw-bold mt-2">Lauku iela 1, Sigulda,<br/> Siguldas nov., LV-2150<br/>
                  @lang('modern house registration number'): 40203251766</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4 justify-content-center">
          <div class="col-lg-12">
            <iframe class="modern-house-location-map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="https://www.openstreetmap.org/export/embed.html?bbox=24.848290085792545%2C57.14056767167189%2C24.85354721546173%2C57.142382401878564&amp;layer=mapnik&amp;marker=57.1414757755372%2C24.850918650627136"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('includes.footer')
  <script>
    let isConsentToProcessData = false;
    let consentToProcessDataCheckbox = document.getElementById('customer-agrees-for-data-processing');
    consentToProcessDataCheckbox.checked = false;

    consentToProcessDataCheckbox.addEventListener('change', (e) => {
      isConsentToProcessData = e.srcElement.checked;
      isConsentToProcessData ? document.getElementById('submit-contact-us').classList.remove('disabled') : document.getElementById('submit-contact-us').classList.add('disabled');
    });
  </script>
@endsection
