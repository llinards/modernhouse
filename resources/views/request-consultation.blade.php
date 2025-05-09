<x-layouts.app :title="Lang::get('request consultation')">
  <x-slot name="header">
    @lang('request consultation')
  </x-slot>
  <x-slot name="slot">
    <div class="row">
      <div class="col-lg-12 d-flex justify-content-center align-items-center flex-column">
        <form method="POST" id="request-consultation-form"
              action="/{{app()->getLocale()}}/request-consultation">
          @include('includes.status-messages')
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
            <input type="email" name="email" class="form-control" id="email"
                   value="{{ old('email') }}">
          </div>
          <div class="mb-3">
            <label for="phone-number" class="form-label fw-bold">@lang('phone number')*</label>
            <input type="tel" name="phone-number" class="form-control" id="phone-number"
                   value="{{ old('phone-number') }}">
          </div>
          <x-agree-data-processing-input/>
          <div class="d-flex align-items-center flex-column">
            <x-submit-button onclick="trackFormSubmit('form_submit_consultation');" :class="'mb-2'"/>
            <div>
              <a class="btn btn-primary d-flex justify-content-center align-items-center"
                 href="/{{ app()->getLocale()}}/"
              >@lang('back')
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </x-slot>
</x-layouts.app>
