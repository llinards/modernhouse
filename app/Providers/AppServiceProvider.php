<?php

namespace App\Providers;

use App\View\Composers\AllActiveProductsComposer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot(): void
  {
//    TODO: Should be addressed
    view()->composer([
      'request-consultation', 'layouts.app'
    ],
      AllActiveProductsComposer::class);
  }
}
