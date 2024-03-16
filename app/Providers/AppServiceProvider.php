<?php

namespace App\Providers;

use App\View\Composers\AllActiveProductsComposer;
use Illuminate\Pagination\Paginator;
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
      'request-consultation', 'components.layouts.home', 'components.layouts.app'
    ],
      AllActiveProductsComposer::class);

    Paginator::useBootstrapFive();
  }
}
