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
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle($request, Closure $next)
  {
    $language = $request->segment(1); // Get the first segment of the URL

    if ($language === 'en') {
      App::setLocale('en'); // Set the application's locale to Latvian
    }

    return $next($request);
  }
}
