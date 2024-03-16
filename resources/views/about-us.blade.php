<x-layouts.app :title="Lang::get('about')">
  <x-slot name="header">
    <h1 class="text-center text-uppercase title">@lang('about')</h1>
  </x-slot>
  <x-slot name="content">
    <div class="row">
      <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column">
        <img class="img-fluid" src="{{ asset('storage/about-us/one.jpg') }}"/>
      </div>
      <div class="col-lg-6 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-4">
        <h2 class="fw-bold title mb-2">@lang('about us title 1 1')</h2>
        <p class="pb-2">@lang('about us content 1 1')</p>
        <p class="pb-2">@lang('about us content 1 2')</p>
        <p>@lang('about us content 1 3')</p>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-lg-6 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-4">
        <h2 class="fw-bold title mb-2">@lang('about us title 2 1')</h2>
        <p>@lang('about us content 2 1')</p>
      </div>
      <div class="col-lg-6 d-flex order-first order-lg-last justify-content-center align-items-center flex-column">
        <img class="img-fluid" src="{{ asset('storage/about-us/two.jpg') }}"/>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column">
        <img class="img-fluid" src="{{ asset('storage/about-us/three.jpg') }}"/>
      </div>
      <div class="col-lg-6 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-4">
        <h2 class="fw-bold title mb-2">@lang('about us title 3 1')</h2>
        <p>@lang('about us content 3 1')</p>
        <p>@lang('about us content 3 2')</p>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-lg-6 d-flex justify-content-center align-items-start flex-column ceo-quot">
        <h5 class="fw-bold mb-2">@lang('about us title 4 1')</h5>
        <p>Helvijs Ervalds</p>
        <p>Modern House CEO</p>
      </div>
      <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column mt-lg-0 mt-4">
        <img class="img-fluid" src="{{ asset('storage/about-us/four.jpg') }}"/>
      </div>
    </div>
  </x-slot>
</x-layouts.app>
