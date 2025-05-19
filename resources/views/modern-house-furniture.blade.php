<x-layouts.app :title="Lang::get('MODERN HOUSE FURNITURE')">
  <x-slot name="header">
    @lang('MODERN HOUSE<br/>FURNITURE')
  </x-slot>
  <x-slot name="slot">
    <div class="row">
      <div class="row mb-4 mx-auto">
        <div
          class="col-12 container-with-image-background-furniture p-lg-5 py-5 d-flex flex-column justify-content-center align-items-center"
          style="background-image:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url({{ asset('storage/modern-house-furniture/1.jpeg')}});background-size:cover;">
          <div class="mb-4 text-center">
            <img src="{{asset('storage/about-us/mh-furniture-logo.png')}}" alt="Modern House Furniture logo"
                 class="modern-house-furniture-logo">
          </div>
          <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
              <h3 class="mb-2 text-center text-white">@lang('furniture title one')</h3>
              <p class="text-center text-white">@lang('furniture content one')</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4 mx-auto">
        <div
          class="col-12 container-with-image-background-furniture p-lg-5 py-5 d-flex flex-column justify-content-center align-items-center"
          style="background-image:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url({{ asset('storage/modern-house-furniture/2.jpg')}});background-size:cover;">
          <div class="row">
            <div class="col-lg-6 offset-lg-6 col-12">
              <h3 class="mb-2 text-center text-lg-start text-white text-uppercase">@lang('furniture title two')</h3>
              <p class="mb-2 text-center text-lg-start text-white">@lang('furniture content two')</p>
              <p class="text-white text-center text-lg-start">@lang('furniture content two two')</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4 mx-auto">
        <div
          class="col-lg-10 col-12 container-with-image-background-furniture p-lg-5 py-5 d-flex flex-column justify-content-center">
          <x-ceo-quot-mh-furniture/>
        </div>
      </div>
      <div class="row mb-4 mx-auto">
        <div
          class="col-12 container-with-image-background-furniture p-lg-5 py-5 d-flex flex-column justify-content-center align-items-center"
          style="background-image:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url({{ asset('storage/modern-house-furniture/3.jpg')}});background-size:cover;">
          <div class="row">
            <div class="col-lg-6 offset-lg-6 col-12">
              <h3 class="mb-2 text-center text-lg-start text-white text-uppercase">@lang('furniture title three')</h3>
              <p class="mb-2 text-center text-lg-start text-white">@lang('furniture content three')</p>
              <p class="text-white text-center text-lg-start">@lang('furniture content three two')</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4 flex-lg-row flex-column mx-auto">
        <div
          class="col-12 container-with-image-background-furniture p-lg-5 d-flex flex-column justify-content-center align-items-center"
          style="background-image:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url({{ asset('storage/modern-house-furniture/4.jpg')}});background-size:cover;">
          <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
              <h3 class="mb-2 text-center text-white">@lang('furniture title five')</h3>
              <p class="mb-2 text-center text-white">@lang('furniture content five')</p>
              <p class="text-center text-white">@lang('furniture content five two')</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mx-auto">
        <div id="contact-us" class="col-lg-6">
          <div class="mb-2">
            <h2 class="text-center">@lang('apply to consultation and learn more')</h2>
          </div>
          <x-contact-us-form :formId="'form_submit_about_us'"
                             :subject="'Jauna ziņa no mājaslapas MODERN HOUSE FURNITURE sadaļas)'"/>
        </div>
      </div>
    </div>
  </x-slot>
</x-layouts.app>
