<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('locale') && config('app.languages.' . $request->route('locale'))) {
            $language = $request->route('locale');
            URL::defaults(['locale' => $language]);
        } elseif (request('language')) {
            session()->put('language', request('language'));
            $language = request('language');
        } elseif (session('language')) {
            $language = session('language');
        } elseif (config('app.locale')) {
            $language = config('app.locale');
        }

        if (isset($language) && config('app.languages.' . $language)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
