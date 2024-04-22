<?php

namespace App\Livewire;

use Livewire\Component;

class OpenDays extends Component
{
  public function render()
  {
    if (app()->getLocale() !== 'lv') {
      abort(404);
    }
    return view('livewire.open-days')->layout('components.layouts.single-view');
  }
}
