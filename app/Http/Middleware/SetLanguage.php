<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLanguage
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle($request, Closure $next)
  {
    $language = $request->segment(1); // Get the first segment of the URL

    $supportedLanguages = array_keys(config('app.languages'));

    if (in_array($language, $supportedLanguages)) {
      App::setLocale($language); // Set the application's locale to Latvian
    } else {
      App::setLocale('app.locale');
    }

    // If the first segment is not a valid language code, redirect to default locale
    if (!in_array($language, $supportedLanguages)) {
      $defaultLocale = 'lv'; // Set your default locale here
      $defaultUrl = url('/'.$defaultLocale.'/'.ltrim($request->getPathInfo(), '/'));
      return redirect($defaultUrl);
    }

    return $next($request);
  }
}
