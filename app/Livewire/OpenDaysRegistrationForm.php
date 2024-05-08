<?php

namespace App\Livewire;

use App\Http\Services\KlaviyoService;
use App\Mail\CustomerRegisteredForOpenDays;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class OpenDaysRegistrationForm extends Component
{
  use UsesSpamProtection;

  public HoneypotData $extraFields;
  public bool $registerView = true;
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
  #[Validate('in:5.jūlijs,6.jūlijs,7.jūlijs', message: 'Pieteikties var tikai 1.jūlijā vai 2.jūlijā.')]
  public string $date = '';

  #[Validate('required', message: 'Laiks ir obligāts.')]
  #[Validate('in:10:00,11:00,12:00,13:00,14:00,15:00,16:00,17:00', message: 'Pieteikties var tikai uz pilnu stundu.')]
  public string $time = '';

  #[Validate('required', message: 'Telefona numurs ir obligāts.')]
  #[Validate('max:255', message: 'Telefona numurs ir aizdomīgi garš.')]
  #[Validate('phone', message: 'Telefona numurs jānorāda ar valsts un/vai reģiona kodu. Piemēram, +371 12345678.')]
  #[Validate('min:8', message: 'Telefona numurs nedrīkst būt īsāks par 8 cipariem.')]
  public string $phoneNumber = '';

  #[Validate('required', message: 'E-pasts ir obligāts.')]
  #[Validate('email', message: 'E-pasts nav derīgs.')]
  public string $email = '';

  public string $questions = '';

  #[Validate('accepted', message: 'Jums ir jāpiekrīt datu apstrādei un uzglabāšanai, lai reģistrētos.')]
  public bool $consentToProcessPersonalData = false;

  public bool $isBackButtonVisible;

  public function register(KlaviyoService $klaviyoService): void
  {
    $this->protectAgainstSpam();
    $this->validate();
    try {
      Mail::to('info@modern-house.lv')->send(new CustomerRegisteredForOpenDays($this->all()));
//      TODO: This should be fixed
      $request = [
        'email' => $this->email,
        'phone-number' => $this->phoneNumber,
        'first-name' => $this->firstName,
        'last-name' => $this->lastName,
      ];
      $klaviyoService->storeProfile($request, config('klaviyo.list_id_register_open_days'));
//      $this->dispatch('registration-successful', $this->date, $this->time);
      $this->showSuccessView($this->date, $this->time);
    } catch (\Exception $e) {
      Log::error($e);
      session()->flash('error', Lang::get('message has not been sent'));
    }
  }

  public function showSuccessView(string $date, string $time): void
  {
    $this->date = $date;
    $this->time = $time;
    $this->registerView = false;
    $this->successView = true;
  }

  public function mount(bool $isBackButtonVisible = true)
  {
    $this->isBackButtonVisible = $isBackButtonVisible;
    $this->extraFields = new HoneypotData();
  }

  public function render()
  {
    return view('livewire.open-days-registration-form');
  }
}
