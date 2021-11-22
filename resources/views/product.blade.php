@extends('app')
@section('content')
  @include('includes.navbar-desktop', ['index' => false])
  @include('includes.navbar-mobile', ['index' => false])
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-7"></div>
      <div class="col-lg-5">
        <div class="title">
          <h1 class="fw-bold text-center text-uppercase">Model 1</h1>
        </div>
        <div class="house-trims">
          <ul class="nav nav-tabs d-flex justify-content-between house-trim-titles pb-4">
            <li class="nav-item">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#premium" type="button">Premium</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#standart" type="button">Standart</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#economy" type="button">Economy</button>
            </li>
          </ul>
          <div class="tab-content house-trim-content">
            <div class="tab-pane show active" id="premium">
              <h1 class="text-center pb-4">EUR 15 000,00</h1>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi debitis rem esse consequuntur
                odit
                alias voluptas dolor laudantium sit! Deserunt cum odio et?</p>
            </div>
            <div class="tab-pane" id="standart">
              <h2>EUR 15000,00</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi debitis rem esse consequuntur
                odit
                alias voluptas dolor laudantium sit! Deserunt cum odio et?</p>
            </div>
            <div class="tab-pane" id="economy">
              <h2>EUR 15000,00</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi debitis rem esse consequuntur
                odit
                alias voluptas dolor laudantium sit! Deserunt cum odio et?</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
