<x-layouts.app :title="Lang::get('contact')">
  <x-slot name="header">
    <h1 class="text-center text-uppercase title">@lang('contact')</h1>
  </x-slot>
  <x-slot name="content">
    <div class="row">
      <div class="col-lg-8 d-flex flex-column justify-content-center">
        <div>
          <h2 class="title mb-2">@lang('contact us title 1')</h2>
          <p>@lang('contact us content 1')</p>
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
    <div class="row mt-4 justify-content-center">
      <div class="mb-2">
        <h2 class="title text-center">@lang('apply to consultation and learn more')</h2>
      </div>
      <div class="col-lg-6">
        <x-contact-us-form :formId="'form_submit_contact_us'" :hideCompanyField="false"
                           :subject="'Jauna ziņa no mājaslapas (kontaktu sadaļas)'"/>
      </div>
    </div>
  </x-slot>
</x-layouts.app>
