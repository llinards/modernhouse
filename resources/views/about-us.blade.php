<x-layouts.app :title="Lang::get('about')">
  <x-slot name="header">
    @lang('about')
  </x-slot>
  <x-slot name="content">
    <div class="row">
      <div class="row mb-4 mx-auto">
        <div
          class="col-12 container-with-image-background p-lg-5 py-5 d-flex flex-column justify-content-center align-items-center"
          style="background-image:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url({{ asset('storage/about-us/1.jpg')}})">
          <h3 class="mb-2 text-center text-white">@lang('about us title one')</h3>
          <p class="text-center text-white">@lang('about us content one')</p>
        </div>
      </div>
      <div class="row mb-4 mx-auto">
        <div
          class="col-12 container-with-image-background p-lg-5 py-5 d-flex flex-column justify-content-center align-items-center"
          style="background-image:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url({{ asset('storage/about-us/2.jpg')}})">
          <div class="row">
            <div class="col-lg-6 offset-lg-6 col-12">
              <h3 class="mb-2 text-center text-white text-uppercase">@lang('about us title two')</h3>
              <p class="text-center text-white">@lang('about us content two')</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4 mx-auto">
        <div
          class="col-12 container-with-image-background p-lg-5 py-5 d-flex flex-column justify-content-center align-items-center"
          style="background-image:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url({{ asset('storage/about-us/3.jpg')}})">
          <div class="row">
            <div class="col-lg-6 col-12">
              <h3 class="mb-2 text-center text-white text-uppercase">@lang('about us title three')</h3>
              <p class="text-center text-white">@lang('about us content three')</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4 mx-auto">
        <div
          class="col-lg-8 col-12 container-with-image-background p-lg-5 py-5 d-flex flex-column justify-content-center">
          <x-ceo-quot/>
        </div>
      </div>
      <div class="row mb-4 flex-lg-row flex-column mx-auto">
        <div
          class="col-12 container-with-image-background p-lg-5 d-flex flex-column justify-content-center align-items-center"
          style="background-image:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url({{ asset('storage/about-us/4.jpg')}})">
          <div class="row">
            <div
              class="col-lg-5 col-12 d-flex align-items-center justify-content-center py-lg-5 pt-5">
              <h3 class="text-white">@lang('about us title five')</h3>
            </div>
            <div class="col-lg-7 col-12 p-lg-5 py-5">
              <p class="mb-2 text-white text-center">@lang('about us content five one')</p>
              <p class="text-white text-center">@lang('about us content five two')</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="mb-2">
            <h2 class="text-center">@lang('apply to consultation and learn more')</h2>
          </div>
          <x-contact-us-form :formId="'form_submit_about_us'" :hideCompanyField="false"
                             :subject="'Jauna ziņa no mājaslapas (par mums sadaļas)'"/>
        </div>
      </div>
    </div>
  </x-slot>
</x-layouts.app>
