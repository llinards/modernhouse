<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OpenDaysRegistrationController;
use App\Http\Controllers\ProductController;
use App\Livewire\OpenDaysRegistration;
use App\Livewire\ShowProduct;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['register' => false]);

Route::middleware(['auth'])->prefix('admin')->group(function () {
  //ProductController
  Route::get('/', [ProductController::class, 'indexAdmin']);
  Route::get('/create', [ProductController::class, 'create']);
  Route::post('/', [ProductController::class, 'store']);
  Route::get('/{product}/edit', [ProductController::class, 'showAdmin']);
  Route::patch('/', [ProductController::class, 'update']);
  Route::get('/{product}/video/delete', [ProductController::class, 'destroyVideo']);
  Route::delete('/{product}/delete', [ProductController::class, 'destroy']);

  //GalleryController
  Route::get('/gallery', [GalleryController::class, 'indexAdmin']);
  Route::get('/gallery/create', [GalleryController::class, 'create']);
  Route::post('/gallery', [GalleryController::class, 'store']);
  Route::get('/gallery/{gallery}/edit', [GalleryController::class, 'show']);
  Route::patch('/gallery', [GalleryController::class, 'update']);
  Route::get('/gallery/{image}/delete', [GalleryController::class, 'destroyImage']);
  Route::delete('/gallery/{gallery}/delete', [GalleryController::class, 'destroy']);

  //NewsController
  Route::get('/news', [NewsController::class, 'indexAdmin']);
  Route::get('/news/create', [NewsController::class, 'create']);
  Route::post('/news', [NewsController::class, 'store']);
  Route::get('/news/{news:id}/edit', [NewsController::class, 'showAdmin']);
  Route::patch('/news', [NewsController::class, 'update']);
  Route::get('/news/image/{image:id}/delete',
    [NewsController::class, 'destroyNewsImage']);
  Route::get('/news/attachment/{attachment:id}/delete',
    [NewsController::class, 'destroyNewsAttachment']);
  Route::delete('/news/{news:id}/delete', [NewsController::class, 'destroy']);

  //ProductVariantController
  Route::get('/product-variant/create', [\App\Http\Controllers\ProductVariantController::class, 'create']);
  Route::post('/product-variant', [\App\Http\Controllers\ProductVariantController::class, 'store']);
  Route::get('/product-variant/{productVariant}/edit',
    [\App\Http\Controllers\ProductVariantController::class, 'show']);
  Route::patch('/product-variant', [\App\Http\Controllers\ProductVariantController::class, 'update']);
  Route::get('/product-variant/image/{image}/delete',
    [\App\Http\Controllers\ProductVariantController::class, 'destroyImage']);
  Route::delete('/product-variant/{productVariant}/delete',
    [\App\Http\Controllers\ProductVariantController::class, 'destroy']);

  //ProductVariantOptionController
  Route::get('/product-variant/{productVariant}/product-variant-options',
    [\App\Http\Controllers\ProductVariantOptionController::class, 'show']);
  Route::patch('/product-variant/{productVariant}/product-variant-options',
    [\App\Http\Controllers\ProductVariantOptionController::class, 'update']);
  Route::post('/product-variant/{productVariant}/product-variant-options',
    [\App\Http\Controllers\ProductVariantOptionController::class, 'store']);
  Route::get('/product-variant/{productVariant}/product-variant-options/{productVariantOption}',
    [\App\Http\Controllers\ProductVariantOptionController::class, 'destroy']);

  //ProductVariantDetailController
  Route::get('/product-variant/{productVariant}/product-variant-details',
    [\App\Http\Controllers\ProductVariantDetailController::class, 'index']);
  Route::get('/product-variant/{productVariant}/product-variant-details/create',
    [\App\Http\Controllers\ProductVariantDetailController::class, 'create']);
  Route::post('/product-variant/{productVariant}/product-variant-details',
    [\App\Http\Controllers\ProductVariantDetailController::class, 'store']);
  Route::get('/product-variant/{productVariant}/product-variant-details/{productVariantDetail}',
    [\App\Http\Controllers\ProductVariantDetailController::class, 'destroy']);

  //HomeController
  Route::post('/upload', [HomeController::class, 'storeTemporaryUpload']);
  Route::delete('/upload', [HomeController::class, 'destroyTemporaryUpload']);

  //OpenDaysRegistrationControlller
  Route::get('/open-days-submissions', [OpenDaysRegistrationController::class, 'index']);
  Route::get('/open-days-submissions/export', [OpenDaysRegistrationController::class, 'export']);
  Route::delete('/open-days-submissions/{openDaysRegistration}/delete',
    [OpenDaysRegistrationController::class, 'destroy']);
});

Route::middleware('setLanguage')->group(function () {
  Route::get('{language?}/', [ProductController::class, 'index']);

  Route::get('{language?}/about-us', static function () {
    return view('about-us');
  });
  Route::get('{language?}/gallery', [GalleryController::class, 'index']);

  Route::get('{language?}/request-consultation', static function () {
    return view('request-consultation');
  });

  Route::post('{language?}/request-consultation',
    [HomeController::class, 'submitConsultation'])->middleware(ProtectAgainstSpam::class);

  Route::get('{language?}/news', [NewsController::class, 'index']);

  Route::get('{language?}/news/{news}', [NewsController::class, 'show']);

  Route::get('{language?}/privacy-policy', static function () {
    return view('privacy-policy');
  });

  Route::get('{language?}/faq', static function () {
    return view('faq');
  });

  Route::get('{language?}/contact-us', static function () {
    return view('contact-us');
  });
  Route::post('{language?}/contact-us',
    [HomeController::class, 'submitContactUs'])->middleware(ProtectAgainstSpam::class);

  //Landing pages
  Route::get('{language?}/projekti/svires-ielas-projekts-sigulda',
    [LandingPageController::class, 'sviresIelasProjektsSigulda']);

  Route::get('{language?}/atverto-durvju-dienas-svires-iela',
    [LandingPageController::class, 'atvertoDurvjuDienasSviresIela']);

  //Registration form for Open Days at Svires Iela
  Route::get('{language?}/pieteikums-atverto-durvju-dienam-svires-iela/{pieteikties?}',
    OpenDaysRegistration::class)->name('registration-for-open-days-at-svires-iela');

  Route::get('{language?}/{product}/{productVariant:slug?}', ShowProduct::class);

  Route::post('{language?}/{product}',
    [HomeController::class, 'requestProductInfo'])->middleware(ProtectAgainstSpam::class);
});
