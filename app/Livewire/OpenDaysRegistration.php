<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class OpenDaysRegistration extends Component
{
  public bool $introductionView = true;
  public bool $registerView = false;
  public bool $successView = false;

  public string $date = '';
  public string $time = '';

  public function mount(string $pieteikties = ''): void
  {
    if ($pieteikties) {
      $this->showRegisterView();
    }
  }

  public function showRegisterView(): void
  {
    $this->introductionView = false;
    $this->registerView = true;
  }

  #[On('registration-successful')]
  public function showSuccessView(string $date, string $time): void
  {
    $this->date = $date;
    $this->time = $time;
    $this->registerView = false;
    $this->successView = true;
  }

  public function render()
  {
    if (app()->getLocale() !== 'lv') {
      abort(404);
    }
    return view('livewire.open-days-registration')->title('Atvērto durvju dienas Svīres ielā')->layout('components.layouts.single-view');
  }
}
