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
Auth::routes();

Route::middleware(['auth'])->prefix('admin')->group(function () {
  Route::get('/', [\App\Http\Controllers\ProductController::class, 'index']);
  Route::get('/create', [\App\Http\Controllers\ProductController::class, 'create']);
  Route::post('/', [\App\Http\Controllers\ProductController::class, 'store']);
  Route::get('/{product}/edit', [\App\Http\Controllers\ProductController::class, 'show']);
  Route::patch('/', [\App\Http\Controllers\ProductController::class, 'update']);
  Route::delete('/{product}/delete', [\App\Http\Controllers\ProductController::class, 'destroy']);

  Route::get('/gallery', [\App\Http\Controllers\GalleryController::class, 'index']);
  Route::get('/gallery/create', [\App\Http\Controllers\GalleryController::class, 'create']);
  Route::post('/gallery', [\App\Http\Controllers\GalleryController::class, 'store']);
  Route::get('/gallery/{gallery}/edit', [\App\Http\Controllers\GalleryController::class, 'show']);
  Route::patch('/gallery', [\App\Http\Controllers\GalleryController::class, 'update']);
  Route::delete('/gallery/{gallery}/delete', [\App\Http\Controllers\GalleryController::class, 'destroy']);

  Route::get('/news', [\App\Http\Controllers\NewsController::class, 'index']);
  Route::get('/news/create', [\App\Http\Controllers\NewsController::class, 'create']);
  Route::post('/news', [\App\Http\Controllers\NewsController::class, 'store']);
  Route::get('/news/{news:id}/edit', [\App\Http\Controllers\NewsController::class, 'show']);
  Route::get('/news/images/{newsImage}/delete',
    [\App\Http\Controllers\NewsController::class, 'destroyNewsImage']);
  Route::get('/news/attachments/{newsAttachment}/delete',
    [\App\Http\Controllers\NewsController::class, 'destroyNewsAttachment']);
  Route::patch('/news', [\App\Http\Controllers\NewsController::class, 'update']);
  Route::delete('/news/{news:id}/delete', [\App\Http\Controllers\NewsController::class, 'destroy']);

  Route::get('/product-variant/create', [\App\Http\Controllers\ProductVariantController::class, 'create']);
  Route::post('/product-variant', [\App\Http\Controllers\ProductVariantController::class, 'store']);
  Route::get('/product-variant/{productVariant}/edit',
    [\App\Http\Controllers\ProductVariantController::class, 'show']);
  Route::patch('/product-variant', [\App\Http\Controllers\ProductVariantController::class, 'update']);
  Route::delete('/product-variant/{productVariant}/delete',
    [\App\Http\Controllers\ProductVariantController::class, 'destroy']);

  Route::get('/product-variant/{productVariant}/product-variant-options',
    [\App\Http\Controllers\ProductVariantOptionController::class, 'show']);
  Route::patch('/product-variant/{productVariant}/product-variant-options',
    [\App\Http\Controllers\ProductVariantOptionController::class, 'update']);
  Route::post('/product-variant/{productVariant}/product-variant-options',
    [\App\Http\Controllers\ProductVariantOptionController::class, 'store']);
  Route::get('/product-variant/{productVariant}/product-variant-options/{productVariantOption}',
    [\App\Http\Controllers\ProductVariantOptionController::class, 'destroy']);

  Route::get('/product-variant/{productVariant}/product-variant-details',
    [\App\Http\Controllers\ProductVariantDetailController::class, 'index']);
  Route::get('/product-variant/{productVariant}/product-variant-details/create',
    [\App\Http\Controllers\ProductVariantDetailController::class, 'create']);
  Route::post('/product-variant/{productVariant}/product-variant-details',
    [\App\Http\Controllers\ProductVariantDetailController::class, 'store']);
  Route::get('/product-variant/{productVariant}/product-variant-details/{productVariantDetail}',
    [\App\Http\Controllers\ProductVariantDetailController::class, 'destroy']);


  Route::get('/image/{image}/delete', [\App\Http\Controllers\ImageController::class, 'destroy']);
  Route::get('/gallery/image/{image}/delete',
    [\App\Http\Controllers\ImageController::class, 'destroyGalleryImages']);

  Route::post('/upload', [\App\Http\Controllers\UploadController::class, 'store']);
  Route::delete('/upload', [\App\Http\Controllers\UploadController::class, 'destroy']);
});

Route::middleware('setLanguage')->group(function () {
  Route::get('{language?}/', [\App\Http\Controllers\HomeController::class, 'index']);

  Route::post('{language?}/request-consultation',
    [\App\Http\Controllers\HomeController::class, 'submitConsultation']);

  Route::get('{language?}/about-us', [\App\Http\Controllers\HomeController::class, 'aboutUs']);
  Route::get('{language?}/gallery', [\App\Http\Controllers\HomeController::class, 'gallery']);
  Route::get('{language?}/news', [\App\Http\Controllers\HomeController::class, 'newsIndex']);
  Route::get('{language?}/news/{newsContent}', [\App\Http\Controllers\HomeController::class, 'newsShow']);
  Route::get('{language?}/privacy-policy', [\App\Http\Controllers\HomeController::class, 'privacyPolicy']);

  Route::get('{language?}/contact-us', [\App\Http\Controllers\HomeController::class, 'contactUs']);
  Route::post('{language?}/contact-us',
    [\App\Http\Controllers\HomeController::class, 'submitContactUs'])->middleware(ProtectAgainstSpam::class);

  Route::get('{language?}/{product}', [\App\Http\Controllers\HomeController::class, 'show']);
  Route::post('{language?}/{product}',
    [\App\Http\Controllers\HomeController::class, 'requestProductInfo'])->middleware(ProtectAgainstSpam::class);
});

