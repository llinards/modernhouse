<div id="open-days-registration">
  @if($introductionView)
    <section class="introduction d-flex flex-column justify-content-around"
             style="background-image:url('{{asset('storage/landing-pages/svires-ielas-projekts-sigulda/introduction.jpg')}}');">
      <div class="text-center">
        <img class="modern-house-logo mb-2" src="{{asset('storage/logo/logo-white.png')}}" alt="MH logo">
        <h1 class="text-white text-uppercase">modern house<br/>atvērto durvju dienas</h1>
      </div>
      <div class="text-center d-flex justify-content-center">
        <button type="button" wire:click="showRegisterView"
                class="btn btn-primary d-flex justify-content-center align-items-center"
        >Reģistrēties
        </button>
      </div>
    </section>
  @elseif($registerView)
    <livewire:open-days-registration-form/>
  @elseif($successView)
    <section class="success d-flex flex-column justify-content-center">
      <div class="row justify-content-center mx-auto">
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
    </section>
  @endif
</div>
