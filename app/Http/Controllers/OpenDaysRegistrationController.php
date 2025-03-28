<?php

namespace App\Http\Controllers;

use App\Exports\OpenDaysRegistrationExport;
use App\Models\OpenDaysRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class OpenDaysRegistrationController extends Controller
{
  public function index()
  {
    $submissions = OpenDaysRegistration::orderByDateTime()->get();

    return view('admin.open-days-registration', compact('submissions'));
  }

  public function destroyOne(OpenDaysRegistration $openDaysRegistration)
  {
    try {
      $openDaysRegistration->delete();

      return back()->with('success', 'Pieteikums izdzēsts!');
    } catch (\Exception $e) {
      Log::error($e);

      return redirect()->back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }

  public function export()
  {
    return Excel::download(new OpenDaysRegistrationExport, 'atverto-durvju-dienas-pieteikumi-'.date('d-m-Y').'.xlsx');
  }

  public function destroy(Request $data)
  {
    try {
      $allSubmissions = OpenDaysRegistration::all();
      foreach ($allSubmissions as $submission) {
        $submission->delete();
      }

      return back()->with('success', 'Pieteikumi izdzēsti!');
    } catch (\Exception $e) {
      Log::error($e);

      return redirect()->back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
