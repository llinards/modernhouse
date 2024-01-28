<form method="POST" action="/{{app()->getLocale()}}/contact-us">
  @include('includes.status-messages')
  @csrf
  <x-honeypot/>
  <input type="text" class="visually-hidden" name="subject"
         value="{{ $subject }}">
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
  <label for="customers-question" class="form-label fw-bold">@lang('questions')</label>
  <textarea class="form-control mb-3" name="customers-question" id="customers-question" rows="3">
                {{ old('customers-question') }}
              </textarea>
  <x-agree-data-processing-input/>
  <x-submit-button/>
</form>
