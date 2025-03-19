<x-layouts.app :title="Lang::get('contact')">
  <x-slot name="header">
    @lang('contact')
  </x-slot>
  <x-slot name="slot">
    <div class="row">
      <div class="col-lg-8 d-flex flex-column justify-content-center">
        <div>
          @lang('contact us content')
        </div>
      </div>
      <div class="col-lg-4 d-flex flex-column mt-lg-0 mt-4">
        <x-staff/>
      </div>
    </div>
    <div class="row mt-4 justify-content-center">
      <div class="col-lg-12">
        <iframe src="https://snazzymaps.com/embed/446182" width="100%"
                height="500px" style="border:none;"></iframe>
      </div>
    </div>
    <div id="contact-us" class="row mt-4 justify-content-center">
      <div class="mb-2">
        <h2 class="text-center">@lang('apply to consultation and learn more')</h2>
      </div>
      <div class="col-lg-6">
        <x-contact-us-form :formId="'form_submit_contact_us'"
                           :subject="'Jauna ziņa no mājaslapas (kontaktu sadaļas)'"/>
      </div>
    </div>
  </x-slot>
</x-layouts.app>
