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

Route::middleware(['auth'])->group(function () {
  Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index']);

  Route::get('/admin/create', [\App\Http\Controllers\ProductController::class, 'create']);
  Route::post('/admin', [\App\Http\Controllers\ProductController::class, 'store']);
  Route::get('/admin/{product}/edit', [\App\Http\Controllers\ProductController::class, 'show']);
  Route::patch('/admin', [\App\Http\Controllers\ProductController::class, 'update']);
  Route::delete('/admin/{product}/delete', [\App\Http\Controllers\ProductController::class, 'destroy']);

  Route::get('/admin/gallery', [\App\Http\Controllers\GalleryController::class, 'index']);
  Route::get('/admin/gallery/create', [\App\Http\Controllers\GalleryController::class, 'create']);
  Route::post('/admin/gallery', [\App\Http\Controllers\GalleryController::class, 'store']);
  Route::get('/admin/gallery/{gallery}/edit', [\App\Http\Controllers\GalleryController::class, 'show']);
  Route::patch('/admin/gallery', [\App\Http\Controllers\GalleryController::class, 'update']);
  Route::delete('/admin/gallery/{gallery}/delete', [\App\Http\Controllers\GalleryController::class, 'destroy']);

  Route::get('/admin/news', [\App\Http\Controllers\NewsController::class, 'index']);
  Route::get('/admin/news/create', [\App\Http\Controllers\NewsController::class, 'create']);
  Route::post('/admin/news', [\App\Http\Controllers\NewsController::class, 'store']);
  Route::get('/admin/news/{news}/edit', [\App\Http\Controllers\NewsController::class, 'show']);
  Route::get('/admin/news/images/{newsImage}/delete', [\App\Http\Controllers\NewsController::class, 'destroyNewsImage']);
  Route::get('/admin/news/attachments/{newsAttachment}/delete', [\App\Http\Controllers\NewsController::class, 'destroyNewsAttachment']);
  Route::patch('/admin/news', [\App\Http\Controllers\NewsController::class, 'update']);
  Route::delete('/admin/news/{news}/delete', [\App\Http\Controllers\NewsController::class, 'destroy']);

  Route::get('/admin/product-variant/create', [\App\Http\Controllers\ProductVariantController::class, 'create']);
  Route::post('/admin/product-variant', [\App\Http\Controllers\ProductVariantController::class, 'store']);
  Route::get('/admin/product-variant/{productVariant}/edit', [\App\Http\Controllers\ProductVariantController::class, 'show']);
  Route::patch('/admin/product-variant', [\App\Http\Controllers\ProductVariantController::class, 'update']);
  Route::delete('/admin/product-variant/{productVariant}/delete', [\App\Http\Controllers\ProductVariantController::class, 'destroy']);

  Route::get('/admin/product-variant/{productVariant}/product-variant-options', [\App\Http\Controllers\ProductVariantOptionController::class, 'show']);
  Route::patch('/admin/product-variant/{productVariant}/product-variant-options', [\App\Http\Controllers\ProductVariantOptionController::class, 'update']);
  Route::post('/admin/product-variant/{productVariant}/product-variant-options', [\App\Http\Controllers\ProductVariantOptionController::class, 'store']);
  Route::get('/admin/product-variant/{productVariant}/product-variant-options/{productVariantOption}', [\App\Http\Controllers\ProductVariantOptionController::class, 'destroy']);

  Route::get('/admin/product-variant/{productVariant}/product-variant-details', [\App\Http\Controllers\ProductVariantDetailController::class, 'index']);
  Route::get('/admin/product-variant/{productVariant}/product-variant-details/create', [\App\Http\Controllers\ProductVariantDetailController::class, 'create']);
  Route::post('/admin/product-variant/{productVariant}/product-variant-details', [\App\Http\Controllers\ProductVariantDetailController::class, 'store']);
  Route::get('/admin/product-variant/{productVariant}/product-variant-details/{productVariantDetail}', [\App\Http\Controllers\ProductVariantDetailController::class, 'destroy']);


  Route::get('/admin/image/{image}/delete', [\App\Http\Controllers\ImageController::class, 'destroy']);
  Route::get('/admin/gallery/image/{image}/delete', [\App\Http\Controllers\ImageController::class, 'destroyGalleryImages']);

  Route::post('/admin/upload', [\App\Http\Controllers\UploadController::class, 'store']);
  Route::delete('/admin/upload', [\App\Http\Controllers\UploadController::class, 'destroy']);
});

Route::group(['prefix' => '{locale}', 'where', ['locale' => '[a-zA-Z]{2}']], function ($locale) {
  Session::put('locale', $locale);
  return redirect()->back();
});


Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/contact-us', [\App\Http\Controllers\HomeController::class, 'contactUs']);
Route::get('/about-us', [\App\Http\Controllers\HomeController::class, 'aboutUs']);
Route::get('/gallery', [\App\Http\Controllers\HomeController::class, 'gallery']);
Route::get('/news', [\App\Http\Controllers\HomeController::class, 'newsIndex']);
Route::get('/news/{newsContent:slug}', [\App\Http\Controllers\HomeController::class, 'newsShow']);
Route::get('/privacy-policy', [\App\Http\Controllers\HomeController::class, 'privacyPolicy']);
Route::post('/contact-us', [\App\Http\Controllers\HomeController::class, 'submitContactUs'])->middleware(ProtectAgainstSpam::class);
Route::get('/{product:slug}', [\App\Http\Controllers\HomeController::class, 'show']);
Route::post('/{product:slug}', [\App\Http\Controllers\HomeController::class, 'requestProductInfo'])->middleware(ProtectAgainstSpam::class)->name('request-product-info');



