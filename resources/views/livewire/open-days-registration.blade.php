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
    <section class="my-4">
      <livewire:open-days-registration-form/>
    </section>
  @endif
</div>
