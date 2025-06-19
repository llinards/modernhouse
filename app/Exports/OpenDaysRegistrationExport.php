<?php

namespace App\Exports;

use App\Models\OpenDaysRegistration;
use Maatwebsite\Excel\Concerns\FromCollection;

class OpenDaysRegistrationExport implements FromCollection
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
    return OpenDaysRegistration::select('firstName', 'lastName', 'date', 'time', 'phoneNumber', 'email', 'reason')
                               ->orderByDateTime()
                               ->get();
  }
}
