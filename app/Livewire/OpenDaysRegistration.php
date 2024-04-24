<?php

namespace App\Livewire;

use App\Http\Services\KlaviyoService;
use App\Mail\CustomerRegisteredForOpenDays;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;

class OpenDaysRegistration extends Component
{
  public bool $introductionView = true;
  public bool $registerView = false;
  public bool $successView = false;

  #[Validate('required', message: 'Vārds ir obligāts.')]
  #[Validate('string', message: 'Vārds drīkst sastāvēt tikai no burtiem.')]
  #[Validate('max:255', message: 'Vārds ir aizdomīgi garš.')]
  #[Validate('alpha', message: 'Vārds drīkst sastāvēt tikai no burtiem.')]
  public string $firstName = '';

  #[Validate('required', message: 'Uzvārds ir obligāts.')]
  #[Validate('string', message: 'Uzvārds drīkst sastāvēt tikai no burtiem.')]
  #[Validate('max:255', message: 'Uzvārds ir aizdomīgi garš.')]
  #[Validate('alpha', message: 'Uzvārds drīkst sastāvēt tikai no burtiem.')]
  public string $lastName = '';

  #[Validate('required', message: 'Datums ir obligāts.')]
  #[Validate('in:1.jūlijs,2.jūlijs', message: 'Pieteikties var tikai 1.jūlijā vai 2.jūlijā.')]
  public string $date = '';

  #[Validate('required', message: 'Laiks ir obligāts.')]
  #[Validate('in:10:00,11:00,12:00,13:00,14:00,15:00,16:00,17:00,18:00,19:00', message: 'Pieteikties var tikai uz pilnu stundu.')]
  public string $time = '';

  #[Validate('required', message: 'Telefona numurs ir obligāts.')]
  #[Validate('max:255', message: 'Telefona numurs ir aizdomīgi garš.')]
  #[Validate('regex:/^([0-9\s\-\+\(\)]*)$/', message: 'Telefona numurs drīkst sastāvēt tikai no cipariem.')]
  #[Validate('min:8', message: 'Telefona numurs nedrīkst būt īsāks par 8 cipariem.')]
  public string $phoneNumber = '';

  #[Validate('required', message: 'E-pasts ir obligāts.')]
  #[Validate('email', message: 'E-pasts nav derīgs.')]
  public string $email = '';

  public string $questions = '';

  #[Validate('accepted', message: 'Jums ir jāpiekrīt datu apstrādei un uzglabāšanai, lai reģistrētos.')]
  public bool $consentToProcessPersonalData = false;

  public function mount(string $register = ''): void
  {
    if ($register) {
      $this->showRegisterView();
    }
  }

  public function showRegisterView(): void
  {
    $this->introductionView = false;
    $this->registerView = true;
  }

  public function register(KlaviyoService $klaviyoService): void
  {
    $this->validate();
    try {
      //TODO: klaviyo integration
      Mail::to('info@modern-house.lv')->send(new CustomerRegisteredForOpenDays($this->all()));
      $data = [
        'email' => $this->email,
        'phone-number' => $this->phoneNumber,
        'first-name' => $this->firstName,
        'last-name' => $this->lastName,
        'company' => ''
      ];
//      $profileId = $klaviyoService->createProfile($data);
//      if ($profileId) {
//        $klaviyoService->subscribeProfile($profileId, config('klaviyo.list_id_register_open_days'), $data);
//      }
      $this->registerView = false;
      $this->successView = true;
    } catch (\Exception $e) {
      Log::error($e);
      session()->flash('error', Lang::get('message has not been sent'));
    }
  }

  public function render()
  {
    if (app()->getLocale() !== 'lv') {
      abort(404);
    }
    return view('livewire.open-days-registration')->title('Atvērto durvju dienas Svīres ielā')->layout('components.layouts.single-view');
  }
}
