@props([
  'companyField' => true,
  'subject' => $subject,
  'formId' => $formId
])
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
    <input type="tel" class="form-control" id="phone-number-display"
           value="{{ old('phone-number') }}" autocomplete="off">
    <input type="hidden" name="phone-number" id="phone-number-full" value="{{ old('phone-number') }}">
  </div>
  @if($companyField)
    <div class="mb-3">
      <label for="company" class="form-label fw-bold">@lang('company')</label>
      <input type="text" name="company" class="form-control" id="company" value="{{ old('company') }}">
    </div>
  @endif
  <label for="customers-question" class="form-label fw-bold">@lang('questions')</label>
  <textarea class="form-control mb-3" name="customers-question" id="customers-question" rows="3">
                {{ old('customers-question') }}
              </textarea>
  <x-agree-data-processing-input/>
  <x-submit-button onclick="trackFormSubmit('{{$formId}}');"/>
</form>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.querySelector('#phone-number-display');
    const fullPhoneNumberInput = document.querySelector('#phone-number-full');

    if (phoneInput && fullPhoneNumberInput) {
      const iti = window.intlTelInput(phoneInput, {
        separateDialCode: true,
        formatOnDisplay: false,
        autoPlaceholder: 'off',
        i18n: {
          search: "@lang('Search country')",
          searchPlaceholder: "@lang('Search')..."
        },
        initialCountry: "lv", // Change this to your default country
      });

      const updateFullNumber = () => {
        const countryCode = iti.getSelectedCountryData().dialCode;
        const phoneNumber = phoneInput.value;
        fullPhoneNumberInput.value = '+' + countryCode + phoneNumber;
      };

      phoneInput.addEventListener('input', updateFullNumber);
      phoneInput.addEventListener('countrychange', updateFullNumber);

      // Initialize with current value if exists
      if (phoneInput.value) {
        updateFullNumber();
      }
    }
  });
</script>
