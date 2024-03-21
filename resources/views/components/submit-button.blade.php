<div {{ $attributes->merge(['class' => 'd-flex justify-content-center']) }}">
<div class="spinner-border visually-hidden" id="loading" role="status">
</div>
<button type="submit" id="submit"
        class="btn btn-primary disabled d-flex justify-content-center align-items-center">
  @lang('send')
</button>
</div>
<script type="module">
  let isConsentToProcessData = false;
  let consentToProcessDataCheckbox = document.getElementById('customer-agrees-for-data-processing');
  const submitBtn = document.getElementById('submit');
  consentToProcessDataCheckbox.checked = false;

  submitBtn.addEventListener('click', () => {
    submitBtn.classList.add('visually-hidden');
    document.getElementById('loading').classList.remove('visually-hidden');
  });

  consentToProcessDataCheckbox.addEventListener('change', (e) => {
    isConsentToProcessData = e.srcElement.checked;
    isConsentToProcessData ? submitBtn.classList.remove('disabled') : submitBtn.classList.add('disabled');
  });
</script>
