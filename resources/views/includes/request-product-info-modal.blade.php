<div class="modal fade" id="request-product-info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-close-btn d-flex justify-content-end p-3">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST"
              action="/{{app()->getLocale()}}/{{$product->slug}}">
          @csrf
          <x-honeypot/>
          <input type="text" class="visually-hidden" name="product-name"
                 value="{{ $product->translations[0]->name }}"/>
          @if(count($productVariants) !== 1)
            <div class="mb-3">
              <label for="product-variant" class="form-label fw-bold">@lang('product variant')*</label>
              <select class="form-select" name="product-variant" id="product-variant"
                      aria-label="Default select example">
                @foreach($productVariants as $productVariant)
                  <option
                    value="{{ $productVariant->translations[0]->name }}">{{ $productVariant->translations[0]->name }}</option>
                @endforeach
              </select>
            </div>
          @endif
          <div class="mb-3">
            <label for="product-variant-option" class="form-label fw-bold">@lang('product variant option')*</label>
            <select class="form-select" name="product-variant-option" id="product-variant-option"
                    aria-label="Default select example">
              <option value="Basic" selected>@lang('basic')</option>
              <option value="Full">@lang('full')</option>
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
          <div class="mb-3">
            <label for="company" class="form-label fw-bold">@lang('company')</label>
            <input type="text" name="company" class="form-control" id="company" value="{{ old('company') }}">
          </div>
          <label for="customers-question" class="form-label fw-bold">@lang('additional questions')</label>
          <textarea class="form-control mb-3" name="customers-question" id="customers-question" rows="3">
            {{ old('customers-question') }}
          </textarea>
          <x-agree-data-processing-input/>
          <x-submit-button onclick="trackFormSubmit('form_submit_product_page');"/>
        </form>
      </div>
    </div>
  </div>
</div>
