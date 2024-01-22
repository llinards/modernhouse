<?php

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
  Route::get('/', [\App\Http\Controllers\ProductController::class, 'indexAdmin']);
  Route::get('/create', [\App\Http\Controllers\ProductController::class, 'create']);
  Route::post('/', [\App\Http\Controllers\ProductController::class, 'store']);
  Route::get('/{product}/edit', [\App\Http\Controllers\ProductController::class, 'showAdmin']);
  Route::patch('/', [\App\Http\Controllers\ProductController::class, 'update']);
  Route::delete('/{product}/delete', [\App\Http\Controllers\ProductController::class, 'destroy']);

  //GalleryController
  Route::get('/gallery', [\App\Http\Controllers\GalleryController::class, 'indexAdmin']);
  Route::get('/gallery/create', [\App\Http\Controllers\GalleryController::class, 'create']);
  Route::post('/gallery', [\App\Http\Controllers\GalleryController::class, 'store']);
  Route::get('/gallery/{gallery}/edit', [\App\Http\Controllers\GalleryController::class, 'show']);
  Route::patch('/gallery', [\App\Http\Controllers\GalleryController::class, 'update']);
  Route::get('/gallery/{image}/delete', [\App\Http\Controllers\GalleryController::class, 'destroyImage']);
  Route::delete('/gallery/{gallery}/delete', [\App\Http\Controllers\GalleryController::class, 'destroy']);

  //NewsController
  Route::get('/news', [\App\Http\Controllers\NewsController::class, 'indexAdmin']);
  Route::get('/news/create', [\App\Http\Controllers\NewsController::class, 'create']);
  Route::post('/news', [\App\Http\Controllers\NewsController::class, 'store']);
  Route::get('/news/{news:id}/edit', [\App\Http\Controllers\NewsController::class, 'showAdmin']);
  Route::patch('/news', [\App\Http\Controllers\NewsController::class, 'update']);
  Route::get('/news/image/{image:id}/delete',
    [\App\Http\Controllers\NewsController::class, 'destroyNewsImage']);
  Route::get('/news/attachment/{attachment:id}/delete',
    [\App\Http\Controllers\NewsController::class, 'destroyNewsAttachment']);
  Route::delete('/news/{news:id}/delete', [\App\Http\Controllers\NewsController::class, 'destroy']);

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
  Route::post('/upload', [\App\Http\Controllers\HomeController::class, 'storeTemporaryUpload']);
  Route::delete('/upload', [\App\Http\Controllers\HomeController::class, 'destroyTemporaryUpload']);
});

Route::middleware('setLanguage')->group(function () {
  Route::get('{language?}/', [\App\Http\Controllers\ProductController::class, 'index']);

  Route::get('{language?}/about-us', static function () {
    return view('about-us');
  });
  Route::get('{language?}/gallery', [\App\Http\Controllers\GalleryController::class, 'index']);

  Route::get('{language?}/request-consultation', static function () {
    return view('request-consultation');
  });

  Route::post('{language?}/request-consultation',
    [\App\Http\Controllers\HomeController::class, 'submitConsultation'])->middleware(ProtectAgainstSpam::class);

  Route::get('{language?}/news', [\App\Http\Controllers\NewsController::class, 'index']);
  Route::get('{language?}/news/{news}', [\App\Http\Controllers\NewsController::class, 'show']);

  Route::get('{language?}/privacy-policy', static function () {
    return view('privacy-policy');
  });

  Route::get('{language?}/contact-us', static function () {
    return view('contact-us');
  });
  Route::post('{language?}/contact-us',
    [\App\Http\Controllers\HomeController::class, 'submitContactUs'])->middleware(ProtectAgainstSpam::class);

  Route::get('{language?}/{product}', [\App\Http\Controllers\ProductController::class, 'show']);
  Route::post('{language?}/{product}',
    [\App\Http\Controllers\HomeController::class, 'requestProductInfo'])->middleware(ProtectAgainstSpam::class);

  //Landing pages

  Route::get('{language?}/projekti/svires-ielas-projekts-sigulda', static function () {
    return view('landing-pages.svires-ielas-projekts-sigulda');
  });
});

