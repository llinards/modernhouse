<div class="modal fade" id="open-days-invitation-modal" tabindex="-1"
     aria-labelledby="Register for open days at Modern House"
     aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-close-btn d-flex justify-content-end p-3">
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
          <i class="bi bi-x-lg text-black"></i>
        </button>
      </div>
      <div class="modal-body pt-0">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-7">
              <img class="img-fluid" src="{{asset('storage/open-days/modal-img.jpg')}}"
                   alt="Family living in the Modern House project">
            </div>
            <div
              class="col-12 col-lg-5 d-flex flex-column justify-content-center align-items-center">
              <div>
                <div class="mb-2 mt-4 mt-lg-0">
                  <h2 class="text-uppercase mb-2">aicinām</h2>
                  <p>uz MODERN HOUSE Svīres ielas<br/>projekta atvērtajām durvju dienām</p>
                </div>
                <ul>
                  <li class="mb-2">
                    <div class="d-flex align-items-center">
                      <img src="{{asset('storage/icons/calendar-check.svg')}}" alt="Calendar icon">
                      <p>5., 6. un 7. jūlijs</p>
                    </div>
                  </li>
                  <li class="mb-2">
                    <div class="d-flex align-items-center">
                      <img src="{{asset('storage/icons/clock.svg')}}" alt="Clock icon">
                      <p>10:00 - 18:00</p>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('storage/icons/map-pin-line-3.svg')}}" alt="Map pin">
                      <p>Sigulda, Svīres iela</p>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-center">
                <a href="{{app()->getLocale()}}/atverto-durvju-dienas-svires-iela#contact-us"
                   class="btn btn-primary text-uppercase d-flex justify-content-center align-items-center">Pieteikties</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  const registerForOpenDaysModal = document.getElementById('open-days-invitation-modal');
  const locale = document.querySelector('meta[name="locale"]').getAttribute('content');
  const declinedOpenDaysRegistration = localStorage.getItem('declinedOpenDaysRegistration');
  const acceptedOpenDaysRegistration = localStorage.getItem('acceptedOpenDaysRegistration');
  const now = new Date().getTime();
  const differenceInDays = Math.floor((now - declinedOpenDaysRegistration) / (1000 * 60 * 60 * 24));

  if (locale === 'lv' && ((differenceInDays > 7 || !declinedOpenDaysRegistration) && !acceptedOpenDaysRegistration)) {
    setTimeout(() => {
      new bootstrap.Modal(registerForOpenDaysModal).show();
    }, 3000);
  }
  registerForOpenDaysModal.addEventListener('hidden.bs.modal', () => {
    localStorage.setItem('declinedOpenDaysRegistration', new Date().getTime());
  });
</script>
