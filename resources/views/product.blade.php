@extends('app')
@section('content')
  @include('includes.navbar-desktop', ['index' => false])
  @include('includes.navbar-mobile', ['index' => false])
  <form method="POST" action="{{ route('submit_order') }}" enctype="multipart/form-data">
    @csrf
    <div class="container-xxl content">
      <div class="row">
        <div class="col-lg-7">
          <div class="product-thumbnail d-flex position-relative">
            <div class="arrow-left d-flex align-items-center m-2">
              <img width="35" height="35" class="invisible" id="previous-photo" src="{{ asset('storage/arrow-down-black.svg') }}" alt="">
            </div>
            <div class="thumbnail-img mb-md-4 mb-lg-0">
              <img class="img-fluid" src="{{ asset('storage/model-1/1.jpg') }}" alt="" id="current-img">
            </div>
            <div class="arrow-right d-flex align-items-center m-2">
              <img width="35" height="35" id="next-photo" src="{{ asset('storage/arrow-down-black.svg') }}" alt="">
            </div>
          </div>
          <div class="product-imgs">
            <img class="img-fluid" src="{{ asset('storage/model-1/1.jpg') }}" alt="">
            <img class="img-fluid" src="{{ asset('storage/model-1/2.jpg') }}" alt="">
            <img class="img-fluid" src="{{ asset('storage/model-1/3.jpg') }}" alt="">
            <img class="img-fluid" src="{{ asset('storage/model-1/4.jpg') }}" alt="">
            <img class="img-fluid" src="{{ asset('storage/model-1/5.jpg') }}" alt="">
            <img class="img-fluid" src="{{ asset('storage/model-1/6.jpg') }}" alt="">
            <img class="img-fluid" src="{{ asset('storage/model-1/7.jpg') }}" alt="">
          </div>
        </div>
        <div class="col-lg-5">
          <div class="title">
            <h1 class="fw-bold text-center text-uppercase">Model 1</h1>
          </div>
          <div class="product-levels">
            <ul class="nav my-4 nav-tabs d-flex product-level-titles flex-nowrap">
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
            <div class="tab-content product-level">
              <div class="tab-pane fade show active" id="premium">
                <div class="product-price">
                  <h1 class="text-center">EUR 15 000,00</h1>
                </div>
                <div class="product-short-description">
                  <p class="small">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi maxime earum cum dolorum, unde molestias eligendi
                    debitis
                    rem esse consequuntur
                    odit
                    alias voluptas dolor laudantium sit! Deserunt cum odio et?</p>
                </div>
                <div class="product-description-btn mt-4 text-center d-flex flex-column justify-content-end align-items-center h-100">
                  <a href="#"
                    class="btn btn-primary btn-main btn-secondary fw-light d-flex justify-content-center align-items-center text-uppercase">@lang('feature
                    details')</a>
                </div>
                <div class="product-options">
                  <div class="product-option my-5 d-flex justify-content-center align-items-center flex-column">
                    <h4 class="fw-bold text-center">Windows</h4>
                    <div class="options d-flex justify-content-center align-items-center">
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon mb-2" type="radio" name="flexRadioDefault" id="" checked>
                        <label class="form-check-label text-center option-label" for="flexRadioDefault">
                          Solid Black Oak
                        </label>
                      </div>
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon mb-2" type="radio" name="flexRadioDefault" id="">
                        <label class="form-check-label text-center option-label" for="flexRadioDefault">
                          Solid Black Oak
                        </label>
                      </div>
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon mb-2" type="radio" name="flexRadioDefault" id="">
                        <label class="form-check-label text-center option-label" for="flexRadioDefault">
                          Solid Black Oak
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="product-option my-5 d-flex justify-content-center align-items-center flex-column">
                    <h4 class="fw-bold text-center">Facade</h4>
                    <div class="options d-flex justify-content-center align-items-center">
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon" type="radio" name="flexRadioDefault2" id="" checked>
                        <label class="form-check-label text-center" for="flexRadioDefault2">
                          Solid Black Oak
                        </label>
                      </div>
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon" type="radio" name="flexRadioDefault2" id="">
                        <label class="form-check-label text-center" for="flexRadioDefault2">
                          Solid Black Oak
                        </label>
                      </div>
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon" type="radio" name="flexRadioDefault2" id="">
                        <label class="form-check-label text-center" for="flexRadioDefault2">
                          Solid Black Oak
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="product-option my-5 d-flex justify-content-center align-items-center flex-column">
                    <h4 class="fw-bold text-center">Roof</h4>
                    <div class="options d-flex justify-content-center align-items-center">
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon" type="radio" name="flexRadioDefault3" id="" checked>
                        <label class="form-check-label text-center" for="flexRadioDefault3">
                          Solid Black Oak
                        </label>
                      </div>
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon" type="radio" name="flexRadioDefault3" id="">
                        <label class="form-check-label text-center" for="flexRadioDefault3">
                          Solid Black Oak
                        </label>
                      </div>
                      <div class="m-3 option form-check">
                        <input class="form-check-input option-icon" type="radio" name="flexRadioDefault3" id="">
                        <label class="form-check-label text-center" for="flexRadioDefault3">
                          Solid Black Oak
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="standart">
              </div>
              <div class="tab-pane fade" id="economy">
              </div>
            </div>
            <div class="product-order d-flex flex-column justify-content-end align-items-center h-100">
              <h4 class="fw-bold text-center mb-2">Order your Model 1</h4>
              <button type="submit"
                class="btn btn-primary btn-main btn-secondary fw-light d-flex justify-content-center align-items-center text-uppercase">@lang('order
                now')</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <script>
    const currentImg = document.getElementById('current-img');
    let allImgs = Array.prototype.slice.call(document.querySelectorAll('.product-imgs img'));
    const opacity = 0.4;
    const nextPhoto = document.getElementById('next-photo');
    const previousPhoto = document.getElementById('previous-photo');
    let currentImgIndex = 0;

    allImgs.forEach((img) => {
      img.addEventListener('click', (e) => {
        allImgs.forEach((img) => {
          img.style.opacity = 1;
        });
        currentImgIndex = allImgs.findIndex(element => element.src == e.target.src);
        currentImg.src = e.target.src;
        e.target.style.opacity = opacity;
        if (currentImgIndex > 0) {
          previousPhoto.classList.remove('invisible');
        } else {
          previousPhoto.classList.add('invisible');
        }
        if (currentImgIndex >= (allImgs.length) - 1) {
          nextPhoto.classList.add('invisible');
        } else {
          nextPhoto.classList.remove('invisible');
        }
      })
    })

    nextPhoto.addEventListener('click', () => {
      currentImgIndex += 1;
      for (let i = 0; i <= allImgs.length; i++) {
        if (i == currentImgIndex) {
          currentImg.src = allImgs[i].src;
        }
      }
      if (currentImgIndex >= (allImgs.length) - 1) {
        nextPhoto.classList.add('invisible');
      }
      previousPhoto.classList.remove('invisible');
    });


    previousPhoto.addEventListener('click', () => {
      currentImgIndex -= 1;
      for (let i = (allImgs.length - 1); i >= 0; i--) {
        if (i == currentImgIndex) {
          currentImg.src = allImgs[i].src;
        }
      }
      if (currentImgIndex == 0) {
        previousPhoto.classList.add('invisible');
      }
      nextPhoto.classList.remove('invisible');
    });
  </script>
@endsection
