<?php

namespace App\Http\Controllers;


use App\Models\OpenDaysRegistration;

class OpenDaysRegistrationController extends Controller
{
  public function index()
  {
    $submissions = OpenDaysRegistration::orderByDateTime()->get();
//    return $submissions;
    return view('admin.open-days-registration', compact('submissions'));
  }

  public function destroy(OpenDaysRegistration $openDaysRegistration)
  {
    $openDaysRegistration->delete();
    return redirect()->back();
  }
}
