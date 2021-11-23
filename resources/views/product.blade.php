@extends('app')
@section('content')
  @include('includes.navbar-desktop', ['index' => false])
  @include('includes.navbar-mobile', ['index' => false])
  <form>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-7"></div>
        <div class="col-lg-5">
          <div class="title">
            <h1 class="fw-bold text-center text-uppercase">Model 1</h1>
          </div>
          <div class="house-trims">
            <ul class="nav nav-tabs d-flex justify-content-between house-trim-titles">
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
                <div class="price">
                  <h1 class="text-center">EUR 15 000,00</h1>
                </div>
                <div class="description">
                  <p class="small">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi
                    debitis
                    rem esse consequuntur
                    odit
                    alias voluptas dolor laudantium sit! Deserunt cum odio et?</p>
                </div>
                <div class="feature-details-btn text-center d-flex flex-column justify-content-end align-items-center h-100">
                  <a href="#" class="btn btn-primary btn-main fw-light d-flex justify-content-center align-items-center">@lang('feature details')</a>
                </div>
                <div class="available-options mt-5">
                  <div class="windows d-flex justify-content-center align-items-center flex-column">
                    <h4 class="fw-bold text-center">Windows</h4>
                    <div class="options d-flex justify-content-center align-items-center">
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon" type="radio" name="flexRadioDefault" id="" checked>
                        <label class="form-check-label text-center" for="flexRadioDefault1">
                          Solid Black Oak
                        </label>
                      </div>
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon" type="radio" name="flexRadioDefault" id="">
                        <label class="form-check-label text-center" for="flexRadioDefault2">
                          Solid Black Oak
                        </label>
                      </div>
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon" type="radio" name="flexRadioDefault" id="">
                        <label class="form-check-label text-center" for="flexRadioDefault2">
                          Solid Black Oak
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="standart">
            </div>
            <div class="tab-pane" id="economy">
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </form>
@endsection
