<div class="container-xxl">
  @if($registerView)
    <div class="row justify-content-center">
      <div class="col-lg-7 col-md-10">
        <div class="text-center">
          <a href="/">
            <img class="modern-house-logo" src="{{asset('storage/logo/logo-black.png')}}" alt="MH logo">
          </a>
          <h4 class="mt-4 mb-2">Gaidīsim Jūs ciemos uz atvērtajām durvju dienām<br/>
            MODERN HOUSE projektā Svīres ielā Siguldā š.g. 5., 6. un 7.jūlijā.
          </h4>
          <p class="mb-4">Izvēlies sev ērtāko dienu un laiku, un
            piesaki savu apmeklējumu.</p>
        </div>
        @include('includes.status-messages')
        <form wire:submit="register">
          <x-honeypot livewire-model="extraFields"/>
          <input type="text" class="visually-hidden" name="subject"
                 value="Pieteikums atvērto durvju dienām Svīres ielas projektā">
          <div class="row mb-3">
            <div class="col-6">
              <label for="firstName" class="form-label fw-bold">Vārds*</label>
              <input type="text" wire:model="firstName" name="firstName" class="form-control">
            </div>
            <div class="col-6">
              <label for="lastName" class="form-label fw-bold">Uzvārds*</label>
              <input required type="text" wire:model="lastName" name="lastName" class="form-control">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-6">
              <label for="date" class="form-label fw-bold">Datums*</label>
              <select class="form-select" wire:model="date" name="date">
                <option selected disabled value="">Izvēlies datumu</option>
                <option value="5.jūlijs">5.jūlijs</option>
                <option value="6.jūlijs">6.jūlijs</option>
                <option value="7.jūlijs">7.jūlijs</option>
              </select>
            </div>
            <div class="col-6">
              <label for="time" class="form-label fw-bold">Laiks*</label>
              <select class="form-select" wire:model="time" name="time">
                <option selected disabled value="">Izvēlies laiku</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label for="phoneNumber" class="form-label fw-bold">Telefona numurs (ar valsts kodu)*</label>
            <input required type="tel" wire:model="phoneNumber" name="phoneNumber" class="form-control">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label fw-bold">E-pasts*</label>
            <input required type="email" wire:model="email" name="email" class="form-control">
          </div>
          <label for="questions" class="form-label fw-bold">Jautājumi</label>
          <textarea class="form-control mb-3" wire:model="questions" name="questions"
                    rows="3"></textarea>
          <div x-data="{ isConsentToProcessData: false }">
            <div class="mb-3 d-flex align-items-center">
              <input class="form-check-input m-0" x-model="isConsentToProcessData"
                     wire:model="consentToProcessPersonalData"
                     value="true"
                     type="checkbox"
                     required
                     name="consentToProcessPersonalData">
              <label for="consentToProcessPersonalData"
                     class="form-label mb-0 d-block mx-2">Piekrītu, ka mani iesniegtie dati tiek apstrādāti un
                uzglabāti.</label>
            </div>
            <div class="d-flex align-items-center flex-column">
              <button type="submit" x-bind:disabled="!isConsentToProcessData"
                      onclick="trackFormSubmit('form_submit_atverto_durvju_diena_svire');"
                      class="btn btn-primary d-flex justify-content-center align-items-center mb-2">
                <div wire:loading class="spinner-border mx-2" id="loading" role="status"></div>
                <span wire:loading.remove>Reģistrēties</span>
              </button>
              @if($isBackButtonVisible)
                <div>
                  <button type="button" class="btn btn-primary d-flex justify-content-center align-items-center"
                          onclick="window.history.back();"
                  >@lang('back')
                  </button>
                </div>
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  @elseif($successView)
    <div class="row justify-content-center align-items-center mx-auto success">
      <div class="col-lg-7 col-md-10">
        <div class="text-center">
          <a href="/">
            <img class="modern-house-logo" src="{{asset('storage/logo/logo-black.png')}}" alt="MH logo">
          </a>
          <h3 class="mt-4 mb-4">Tiekamies {{substr_replace($date, 'ā', -1)}} {{$time}} uz kopīgu
            piedzīvojumu atvērtajās durvju dienās Svīres ielā, Siguldā!</h3>
          </h3>
        </div>
        <div class="d-flex justify-content-center">
          <a href="/"
             class="btn btn-primary d-flex justify-content-center align-items-center"
          >Uz sākumu
          </a>
        </div>
      </div>
    </div>
  @endif
</div>
<script>
  addEventListener('submit', () => {
    localStorage.setItem('acceptedOpenDaysRegistration', 'true');
  });
</script>
