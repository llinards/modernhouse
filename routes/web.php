<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OpenDaysRegistrationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductVariantDetailController;
use App\Http\Controllers\ProductVariantOptionController;
use App\Livewire\OpenDaysRegistration;
use App\Livewire\ShowProduct;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

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
  Route::get('/product-variant/create', [ProductVariantController::class, 'create']);
  Route::post('/product-variant', [ProductVariantController::class, 'store']);
  Route::get('/product-variant/{productVariant}/edit',
    [ProductVariantController::class, 'show']);
  Route::patch('/product-variant', [ProductVariantController::class, 'update']);
  Route::delete('/product-variant/{productVariant}/delete',
    [ProductVariantController::class, 'destroy']);

  //ProductVariantOptionController
  Route::get('/product-variant/{productVariant}/product-variant-options',
    [ProductVariantOptionController::class, 'index'])->name('product-variant-options.index');
  Route::post('/product-variant/{productVariant}/product-variant-options',
    [ProductVariantOptionController::class, 'import'])->name('product-variant-options.import');
  Route::post('/product-variant/product-variant-options/create',
    [
      ProductVariantOptionController::class, 'storeProductVariantOption',
    ])->name('product-variant-options.store-product-variant-option');
  Route::post('/product-variant/product-variant-options/product-variant-option-detail/create',
    [
      ProductVariantOptionController::class, 'storeProductVariantOptionDetail',
    ])->name('product-variant-options.store-product-variant-option-detail');
  Route::patch('/product-variant/product-variant-options/{productVariantOption}/update',
    [
      ProductVariantOptionController::class, 'updateProductVariantOption',
    ])->name('product-variant-options.update-product-variant-option');
  Route::patch('/product-variant/product-variant-options/product-variant-option-detail/{productVariantOptionDetail}/update',
    [
      ProductVariantOptionController::class, 'updateProductVariantOptionDetail',
    ])->name('product-variant-options.update-product-variant-option-detail');

  Route::delete('/product-variant/{productVariant}/product-variant-options/delete',
    [ProductVariantOptionController::class, 'destroy'])->name('product-variant-options.destroy');
  Route::delete('/product-variant/product-variant-options/{productVariantOption}/delete',
    [
      ProductVariantOptionController::class, 'destroyProductVariantOption',
    ])->name('product-variant-options.destroy-product-variant-option');
  Route::delete('/product-variant/product-variant-options/product-variant-option-detail/{productVariantOptionDetail}/delete',
    [
      ProductVariantOptionController::class, 'destroyProductVariantOptionDetail',
    ])->name('product-variant-options.destroy-product-variant-option-detail');

  //ProductVariantDetailController
  Route::get('/product-variant/{productVariant}/product-variant-details',
    [ProductVariantDetailController::class, 'index']);
  Route::get('/product-variant/{productVariant}/product-variant-details/create',
    [ProductVariantDetailController::class, 'create']);
  Route::post('/product-variant/{productVariant}/product-variant-details',
    [ProductVariantDetailController::class, 'store']);
  Route::get('/product-variant/{productVariant}/product-variant-details/{productVariantDetail}',
    [ProductVariantDetailController::class, 'destroy']);

  //HomeController
  Route::post('/upload', [HomeController::class, 'storeTemporaryUpload']);
  Route::delete('/upload', [HomeController::class, 'destroyTemporaryUpload']);

  //OpenDaysRegistrationControlller
  Route::get('/open-days-submissions', [OpenDaysRegistrationController::class, 'index']);
  Route::get('/open-days-submissions/export', [OpenDaysRegistrationController::class, 'export']);
  Route::delete('/open-days-submissions/all/delete',
    [OpenDaysRegistrationController::class, 'destroy']);
  Route::delete('/open-days-submissions/{openDaysRegistration}/delete',
    [OpenDaysRegistrationController::class, 'destroyOne']);
});

Route::middleware('setLanguage')->group(function () {
  Route::get('{language?}/', [ProductController::class, 'index']);

  Route::get('{language?}/about-us', static function () {
    return view('about-us');
  });

  Route::get('{language?}/modern-house-furniture', static function () {
    return view('modern-house-furniture');
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

  Route::get('{language?}/modern-house-maju-marsruts-2025', static function ($language) {
    if ($language === 'lv') {
      return view('landing-pages.modern-house-maju-marsruts-2025');
    }
    abort(404);
  });


  //Registration form for Open Days at Svires Iela
  Route::get('{language?}/pieteikums-atverto-durvju-dienam-svires-iela/{pieteikties?}',
    OpenDaysRegistration::class)->name('registration-for-open-days-at-svires-iela');

  Route::get('{language?}/{product}/{productVariant:slug?}', ShowProduct::class);

  Route::post('{language?}/{product}',
    [HomeController::class, 'requestProductInfo'])->middleware(ProtectAgainstSpam::class);
});
