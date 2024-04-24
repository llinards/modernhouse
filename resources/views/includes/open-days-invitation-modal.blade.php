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
                      <img src="{{asset('storage/open-days/calendar-check.svg')}}" alt="Calendar icon">
                      <p>1. un 2. jūlijs</p>
                    </div>
                  </li>
                  <li class="mb-2">
                    <div class="d-flex align-items-center">
                      <img src="{{asset('storage/open-days/clock.svg')}}" alt="Clock icon">
                      <p>10:00 - 19:00</p>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex align-items-center">
                      <img src="{{asset('storage/open-days/map-pin-line-3.svg')}}" alt="Map pin">
                      <p>Sigulda, Svīres iela</p>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="d-flex justify-content-center">
                <a href="{{route('registration-for-open-days-at-svires-iela', [app()->getLocale(), 'register'])}}"
                   id="register-for-open-days"
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
  const lastVisit = localStorage.getItem('lastVisit');
  const now = new Date().getTime();
  const differenceInDays = Math.floor((now - lastVisit) / (1000 * 60 * 60 * 24));
  const setLocalStorage = () => {
    localStorage.setItem('lastVisit', new Date().getTime());
  }

  if (locale === 'lv' && (differenceInDays > 1 || !lastVisit)) {
    setTimeout(() => {
      new bootstrap.Modal(registerForOpenDaysModal).show();
    }, 3000);
  }
  document.getElementById('register-for-open-days').addEventListener('click', () => {
    setLocalStorage();
  });
  registerForOpenDaysModal.addEventListener('hidden.bs.modal', () => {
    setLocalStorage();
  });
</script>
