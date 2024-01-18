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
    view()->composer([
      'product', 'request-consultation', 'news.index', 'news.show', 'gallery', 'about-us', 'contact-us',
      'privacy-policy', 'landing-pages.svires-ielas-projekts-sigulda'
    ],
      AllActiveProductsComposer::class);
  }
}
