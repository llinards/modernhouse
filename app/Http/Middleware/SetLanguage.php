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
   * @param Closure(Request): (Response) $next
   */
  public function handle($request, Closure $next): mixed
  {
    $language = $request->segment(1);
    $supportedLanguages = array_keys(config('app.languages'));

    $changeLanguage = $request->query('changeLanguage');
    if ($changeLanguage && in_array($changeLanguage, $supportedLanguages, true)) {
      App::setLocale($changeLanguage);
      $pathWithoutLanguage = ltrim(substr($request->getPathInfo(), 3), '/');
      $newUrl = url('/' . $changeLanguage . '/' . $pathWithoutLanguage);
      return redirect($newUrl);
    } else {
      if (in_array($language, $supportedLanguages, true)) {
        App::setLocale($language);
      } else {
        App::setLocale(config('app.locale'));
        $defaultLocale = config('app.locale');
        $defaultUrl = url('/' . $defaultLocale . '/' . ltrim($request->getPathInfo(), '/'));
        return redirect($defaultUrl);
      }
    }

    return $next($request);
  }
}
