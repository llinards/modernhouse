<?php

namespace App\Http\Controllers;

use App\Exports\OpenDaysRegistrationExport;
use App\Models\OpenDaysRegistration;
use Maatwebsite\Excel\Facades\Excel;

class OpenDaysRegistrationController extends Controller
{
  public function index()
  {
    $submissions = OpenDaysRegistration::orderByDateTime()->get();
    return view('admin.open-days-registration', compact('submissions'));
  }

  public function destroy(OpenDaysRegistration $openDaysRegistration)
  {
    $openDaysRegistration->delete();
    return redirect()->back();
  }

  public function export()
  {
    return Excel::download(new OpenDaysRegistrationExport, 'atverto-durvju-dienas-pieteikumi-'.date('d-m-Y').'.xlsx');
  }
}
