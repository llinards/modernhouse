<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\IntroductionVideoController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OpenDaysRegistrationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductVariantOptionController;
use App\Http\Controllers\TemporaryUploadController;
use App\Livewire\OpenDaysRegistration;
use App\Livewire\ShowProduct;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Auth::routes(['register' => false, 'reset' => false]);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All admin routes require authentication and are prefixed with
| "admin/{locale}" where locale is a two-letter language code.
|
*/

// Redirect /admin to the localized admin products index
Route::middleware(['auth'])->prefix('admin')->group(function () {
  Route::get('/', static function () {
    return redirect()->route('admin.products.index', ['locale' => app()->getLocale()]);
  });
});

Route::middleware(['auth'])->prefix('admin/{locale}')->where(['locale' => '[a-z]{2}'])->group(function () {

  /* Products */
  Route::get('/', [ProductController::class, 'indexAdmin'])->name('admin.products.index');
  Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
  Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
  Route::get('/products/{product}/edit', [ProductController::class, 'showAdmin'])->name('admin.products.edit');
  Route::patch('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
  Route::delete('/products/{product}/video', [ProductController::class, 'destroyVideo'])->name('admin.products.destroyVideo');
  Route::delete('/products/{product}/delete', [ProductController::class, 'destroy'])->name('admin.products.destroy');

  /* Gallery */
  Route::get('/gallery', [GalleryController::class, 'indexAdmin']);
  Route::get('/gallery/create', [GalleryController::class, 'create']);
  Route::post('/gallery', [GalleryController::class, 'store']);
  Route::get('/gallery/{gallery}/edit', [GalleryController::class, 'show']);
  Route::patch('/gallery', [GalleryController::class, 'update']);
  Route::get('/gallery/{image}/delete', [GalleryController::class, 'destroyImage']);
  Route::delete('/gallery/{gallery}/delete', [GalleryController::class, 'destroy']);

  /* News */
  Route::get('/news', [NewsController::class, 'indexAdmin']);
  Route::get('/news/create', [NewsController::class, 'create']);
  Route::post('/news', [NewsController::class, 'store']);
  Route::get('/news/{news:id}/edit', [NewsController::class, 'showAdmin']);
  Route::patch('/news', [NewsController::class, 'update']);
  Route::get('/news/image/{image:id}/delete', [NewsController::class, 'destroyNewsImage']);
  Route::get('/news/attachment/{attachment:id}/delete', [NewsController::class, 'destroyNewsAttachment']);
  Route::delete('/news/{news:id}/delete', [NewsController::class, 'destroy']);

  /* Product Variants */
  Route::get('/product-variant/create', [ProductVariantController::class, 'create'])->name('admin.product-variants.create');
  Route::post('/product-variant', [ProductVariantController::class, 'store'])->name('admin.product-variants.store');
  Route::get('/product-variant/{productVariant}/edit', [ProductVariantController::class, 'show'])->name('admin.product-variants.edit');
  Route::patch('/product-variant/{productVariant}', [ProductVariantController::class, 'update'])->name('admin.product-variants.update');
  Route::delete('/product-variant/{productVariant}/delete', [ProductVariantController::class, 'destroy'])->name('admin.product-variants.destroy');

  /* Product Variant Options */
  Route::get('/product-variant/{productVariant}/product-variant-options',
    [ProductVariantOptionController::class, 'index'])->name('product-variant-options.index');
  Route::post('/product-variant/{productVariant}/product-variant-options',
    [ProductVariantOptionController::class, 'import'])->name('product-variant-options.import');
  Route::post('/product-variant/product-variant-options/create',
    [ProductVariantOptionController::class, 'storeProductVariantOption'])->name('product-variant-options.store-product-variant-option');
  Route::post('/product-variant/product-variant-options/product-variant-option-detail/create',
    [ProductVariantOptionController::class, 'storeProductVariantOptionDetail'])->name('product-variant-options.store-product-variant-option-detail');
  Route::patch('/product-variant/product-variant-options/{productVariantOption}/update',
    [ProductVariantOptionController::class, 'updateProductVariantOption'])->name('product-variant-options.update-product-variant-option');
  Route::patch('/product-variant/product-variant-options/product-variant-option-detail/{productVariantOptionDetail}/update',
    [ProductVariantOptionController::class, 'updateProductVariantOptionDetail'])->name('product-variant-options.update-product-variant-option-detail');
  Route::delete('/product-variant/{productVariant}/product-variant-options/delete',
    [ProductVariantOptionController::class, 'destroy'])->name('product-variant-options.destroy');
  Route::delete('/product-variant/product-variant-options/{productVariantOption}/delete',
    [ProductVariantOptionController::class, 'destroyProductVariantOption'])->name('product-variant-options.destroy-product-variant-option');
  Route::delete('/product-variant/product-variant-options/product-variant-option-detail/{productVariantOptionDetail}/delete',
    [ProductVariantOptionController::class, 'destroyProductVariantOptionDetail'])->name('product-variant-options.destroy-product-variant-option-detail');

  /* Introduction Video */
  Route::patch('/introduction-video', [IntroductionVideoController::class, 'update'])->name('admin.introduction-video.update');

  /* Temporary Uploads (FilePond) */
  Route::post('/upload', [TemporaryUploadController::class, 'store']);
  Route::delete('/upload', [TemporaryUploadController::class, 'destroy']);
  Route::get('/upload', [TemporaryUploadController::class, 'load']);

  /* Open Days Submissions */
  Route::get('/open-days-submissions', [OpenDaysRegistrationController::class, 'index']);
  Route::get('/open-days-submissions/export', [OpenDaysRegistrationController::class, 'export']);
  Route::delete('/open-days-submissions/all/delete', [OpenDaysRegistrationController::class, 'destroy']);
  Route::delete('/open-days-submissions/{openDaysRegistration}/delete', [OpenDaysRegistrationController::class, 'destroyOne']);
});

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| All public routes use the "setLanguage" middleware and accept an
| optional {language} prefix for locale switching.
|
*/

Route::middleware('setLanguage')->group(function () {

  /* Homepage */
  Route::get('{language?}/', [ProductController::class, 'index']);

  /* Static Pages */
  Route::get('{language?}/about-us', static function () {
    return view('about-us');
  });

  Route::get('{language?}/modern-house-furniture', static function () {
    return view('modern-house-furniture');
  });

  Route::get('{language?}/request-consultation', static function () {
    return view('request-consultation');
  });

  Route::post('{language?}/request-consultation',
    [ContactController::class, 'submitConsultation'])->middleware(ProtectAgainstSpam::class);

  Route::get('{language?}/privacy-policy', static function () {
    return view('privacy-policy');
  })->name('privacy-policy');

  Route::get('{language?}/faq', static function () {
    return view('faq');
  });

  Route::get('{language?}/contact-us', static function () {
    return view('contact-us');
  });

  Route::post('{language?}/contact-us',
    [ContactController::class, 'submitContactUs'])->middleware(ProtectAgainstSpam::class);

  /* Gallery */
  Route::get('{language?}/gallery', [GalleryController::class, 'index']);

  /* News */
  Route::get('{language?}/news', [NewsController::class, 'index']);
  Route::get('{language?}/news/{news}', [NewsController::class, 'show']);

  /* Landing Pages */
  Route::redirect('{language?}/projekti/svires-ielas-projekts-sigulda', '/');

  // Latvian-only landing page — returns 404 for other locales
  Route::get('{language?}/modern-house-maju-marsruts-2025', static function ($language) {
    if ($language === 'lv') {
      return view('landing-pages.modern-house-maju-marsruts-2025');
    }
    abort(404);
  });

  /* Open Days Registration (Livewire) */
  Route::get('{language?}/pieteikums-atverto-durvju-dienam-svires-iela/{pieteikties?}',
    OpenDaysRegistration::class)->name('registration-for-open-days-at-svires-iela');

  /* Product Pages — catch-all, must remain last */
  Route::get('{language?}/{product}/{productVariant:slug?}', ShowProduct::class);

  Route::post('{language?}/{product}',
    [ContactController::class, 'requestProductInfo'])->middleware(ProtectAgainstSpam::class);
});
