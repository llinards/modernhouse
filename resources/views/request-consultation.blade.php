@extends('app', ['title' => Lang::get('request consultation'), 'index' => false])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('request consultation')</h1>
      @include('includes.status-messages')
      <div class="mt-4">
        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center align-items-center flex-column mt-lg-0 mt-4">
            <form method="POST" id="request-consultation-form"
                  action="/{{app()->getLocale()}}/request-consultation">
              @csrf
              <x-honeypot/>
              <div class="mb-3">
                <label for="product" class="form-label fw-bold">@lang('product interested')*</label>
                <select class="form-select" name="product-variant" id="product"
                        aria-label="Default select example">
                  @foreach($allActiveProducts as $product)
                    <option
                      value="{{ $product->translations[0]->name }}">{{ $product->translations[0]->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="first-name" class="form-label fw-bold">@lang('first name')*</label>
                <input type="text" name="first-name" class="form-control" id="first-name"
                       value="{{ old('first-name') }}">
              </div>
              <div class="mb-3">
                <label for="last-name" class="form-label fw-bold">@lang('last name')*</label>
                <input type="text" name="last-name" class="form-control" id="last-name"
                       value="{{ old('last-name') }}">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label fw-bold">@lang('email')*</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
              </div>
              <div class="mb-3">
                <label for="phone-number" class="form-label fw-bold">@lang('phone number')*</label>
                <input type="tel" name="phone-number" class="form-control" id="phone-number"
                       value="{{ old('phone-number') }}">
              </div>
              <div class="mb-3 d-flex align-items-center">
                <input class="form-check-input m-0" type="checkbox" value="1" id="customer-agrees-for-data-processing"
                       name="customer-agrees-for-data-processing"
                >
                <label for="customer-agrees-for-data-processing"
                       class="form-label mb-0 d-block mx-2">@lang('data processing agreement')</label>
              </div>
              <div class="modal-footer d-flex justify-content-center">
                <div class="d-flex flex-column">
                  <div class="mb-2 text-center">
                    <div class="spinner-border visually-hidden" id="submit-consultation-loading" role="status">
                    </div>
                    <button type="submit" id="submit-consultation"
                            class="btn btn-primary disabled fw-light d-flex justify-content-center align-items-center">@lang('send')
                    </button>
                  </div>
                  <div>
                    <a class="btn btn-primary fw-light d-flex justify-content-center align-items-center"
                       href="/{{ app()->getLocale()}}/"
                    >@lang('back')
                    </a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('includes.footer')
  <script>
    let isConsentToProcessData = false;
    let consentToProcessDataCheckbox = document.getElementById('customer-agrees-for-data-processing');
    const submitBtn = document.getElementById('submit-consultation');
    consentToProcessDataCheckbox.checked = false;

    submitBtn.addEventListener('click', (e) => {
      submitBtn.classList.add('visually-hidden');
      document.getElementById('submit-consultation-loading').classList.remove('visually-hidden');
    });

    consentToProcessDataCheckbox.addEventListener('change', (e) => {
      isConsentToProcessData = e.srcElement.checked;
      isConsentToProcessData ? submitBtn.classList.remove('disabled') : submitBtn.classList.add('disabled');
    });
  </script>
@endsection
