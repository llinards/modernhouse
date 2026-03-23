<?php

namespace App\Http\Controllers;

use App\Exceptions\FfmpegNotFoundException;
use App\Http\Requests\UpdateIntroductionVideoRequest;
use App\Http\Services\IntroductionVideoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class IntroductionVideoController extends Controller
{
  public function update(UpdateIntroductionVideoRequest $request, IntroductionVideoService $introductionVideoService): RedirectResponse
  {
    try {
      $introductionVideoService->replaceVideo($request->input('introduction-video'));

      return back()->with('success', 'Video veiksmīgi atjaunots!');
    } catch (FfmpegNotFoundException $e) {
      Log::warning($e->getMessage());

      return back()->with('warning', 'Video saglabāts, bet priekšskatījuma bilde netika ģenerēta — FFmpeg nav instalēts.');
    } catch (\Exception $e) {
      Log::error($e);

      return back()->with('error', 'Kļūda! Mēģini vēlreiz.');
    }
  }
}
