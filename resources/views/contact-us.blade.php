@extends('layouts.app', ['title' => Lang::get('contact'), 'index' => false])
@section('content')
  <div class="container-xxl mb-4">
    <div class="row">
      <h1 class="fw-bold text-center text-uppercase title">@lang('contact')</h1>
      <div class="mt-4">
        <div class="row">
          <div class="col-lg-6 d-flex justify-content-center align-items-center flex-column mt-lg-0 mt-4">
            <x-contact-us-form :formId="'Forma - Kontakti sadaļa'" :hideCompanyField="false"
                               :subject="'Jauna ziņa no mājaslapas (kontaktu sadaļas)'"/>
          </div>
          <div class="col-lg-6 order-first order-lg-last d-flex justify-content-center align-items-between flex-column">
            <x-staff/>
          </div>
        </div>
        <div class="row mt-4 justify-content-center">
          <div class="col-lg-12">
            <iframe class="modern-house-location-map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                    src="https://www.openstreetmap.org/export/embed.html?bbox=24.848290085792545%2C57.14056767167189%2C24.85354721546173%2C57.142382401878564&amp;layer=mapnik&amp;marker=57.1414757755372%2C24.850918650627136"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('includes.footer')
@endsection
