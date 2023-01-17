@extends('app', ['title' => Lang::get('contact'), 'index' => false, 'allProducts' => $allProducts])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <div class="title">
        <h1 class="fw-bold text-center text-uppercase">@lang('contact')</h1>
      </div>
      @include('includes.status-messages')
      <div class="contact-information mt-4">
        <div class="row">
          <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column">
            <h2 class="mb-2">Adrese:</h2>
            <p class="text-uppercase">modern house sia</p>
            <p>Lauku iela 1, Sigulda, Siguldas nov., LV-2150</p>
            <p>@lang('modern house registration number'): 40203251766</p>
            <p class="mt-1"><a class="nav-link" href="mailto:info@modern-house.lv">info@modern-house.lv</a></p>
          </div>
          <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column mt-lg-0 mt-5">
            <iframe class="modern-house-location-map" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=24.848290085792545%2C57.14056767167189%2C24.85354721546173%2C57.142382401878564&amp;layer=mapnik&amp;marker=57.1414757755372%2C24.850918650627136"></iframe>
          </div>
        </div>
        <div class="row mt-4 justify-content-center">
          <div class="col-lg-8 contact-us-form">
            <h2 class="text-center mb-2">Sazināties ar mums</h2>
            <form method="POST" action="/contact-us">
              @csrf
              <x-honeypot />
              <div class="mb-3">
                <label for="name-surname" class="form-label fw-bold">Vārds, uzvārds*</label>
                <input type="text" name="name-surname" class="form-control" id="name-surname" value="{{ old('name-surname') }}">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label fw-bold">E-pasts*</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
              </div>
              <div class="mb-3">
                <label for="phone-number" class="form-label fw-bold">Kontakttālrunis*</label>
                <input type="tel" name="phone-number" class="form-control" id="phone-number" value="{{ old('phone-number') }}">
              </div>
              <div class="mb-3">
                <label for="company" class="form-label fw-bold">Uzņēmums</label>
                <input type="text" name="company" class="form-control" id="company" value="{{ old('company') }}">
              </div>
              <label for="customers-question" class="form-label fw-bold">Jautājumi</label>
              <textarea class="form-control" name="customers-question" id="customers-question" rows="3">
                {{ old('customers-question') }}
              </textarea>
              <div class="d-flex justify-content-center">
                <button type="submit" class="mt-4 btn btn-primary fw-light d-flex justify-content-center align-items-center text-uppercase">Nosūtīt</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('includes.footer')
@endsection
