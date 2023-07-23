<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
  /**
   * Handle an incoming request.
   *
   * @param  Closure(Request): (Response)  $next
   */
  public function handle($request, Closure $next): mixed
  {
    $language = $request->segment(1);
    $supportedLanguages = array_keys(config('app.languages'));

    if (in_array($language, $supportedLanguages, true)) {
      App::setLocale($language);
    } else {
      App::setLocale('app.locale');
    }

    if (!in_array($language, $supportedLanguages, true)) {
      $defaultLocale = 'lv';
      $defaultUrl = url('/'.$defaultLocale.'/'.ltrim($request->getPathInfo(), '/'));
      return redirect($defaultUrl);
    }

    return $next($request);
  }
}
