<div class="modal fade" id="request-consultation">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-close-btn d-flex justify-content-end p-3">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="request-consultation-form"
              action="/{{app()->getLocale()}}/request-consultation">
          @csrf
          <x-honeypot/>
          @include('includes.status-messages')
          @if(count($allProducts) !== 1)
            <div class="mb-3">
              <label for="product" class="form-label fw-bold">@lang('product interested')*</label>
              <select class="form-select" name="product-variant" id="product"
                      aria-label="Default select example">
                @foreach($allProducts as $product)
                  <option
                    value="{{ $product->{'name_'.app()->getLocale()} }}">{{ $product->{'name_'.app()->getLocale()} }}</option>
                @endforeach
              </select>
            </div>
          @endif
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
            <div class="spinner-border visually-hidden" id="submit-consultation-loading" role="status">
            </div>
            <button type="button" id="submit-consultation"
                    class="btn btn-primary disabled fw-light d-flex justify-content-center align-items-center">@lang('send')
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  let isConsentToProcessData = false;
  let consentToProcessDataCheckbox = document.getElementById('customer-agrees-for-data-processing');
  const submitBtn = document.getElementById('submit-consultation');
  consentToProcessDataCheckbox.checked = false;
  
  submitBtn.addEventListener('click', (e) => {
    e.preventDefault();
    submitBtn.classList.add('visually-hidden');
    document.getElementById('submit-consultation-loading').classList.remove('visually-hidden');
  });

  consentToProcessDataCheckbox.addEventListener('change', (e) => {
    isConsentToProcessData = e.srcElement.checked;
    isConsentToProcessData ? submitBtn.classList.remove('disabled') : submitBtn.classList.add('disabled');
  });
</script>
