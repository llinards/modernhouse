<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpenDaysRegistration extends Model
{
  protected $fillable = [
    'firstName',
    'lastName',
    'date',
    'time',
    'phoneNumber',
    'email',
    'reason',
    'consentToProcessPersonalData',
  ];

  public function scopeOrderByDateTime($query)
  {
    return $query->orderBy('date', 'asc')->orderBy('time', 'asc');
  }
}
