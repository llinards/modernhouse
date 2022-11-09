<?php

use Illuminate\Http\Client\Request;
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
  Route::get('/admin', [\App\Http\Controllers\ProductController::class, 'index'] );
  Route::get('/admin/create', [\App\Http\Controllers\ProductController::class, 'create'] );
  Route::post('/admin', [\App\Http\Controllers\ProductController::class, 'store'] );
  Route::get('/admin/{product:slug}/edit', [\App\Http\Controllers\ProductController::class, 'show'] );
  Route::patch('/admin', [\App\Http\Controllers\ProductController::class, 'update']);

  Route::post('/admin/upload', [\App\Http\Controllers\UploadController::class, 'store']);
  Route::delete('/admin/upload', [\App\Http\Controllers\UploadController::class, 'destroy']);
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/{product:slug}', [\App\Http\Controllers\HomeController::class, 'show']);
Route::post('/{product:slug}', [\App\Http\Controllers\HomeController::class, 'requestProductInfo'])->middleware(ProtectAgainstSpam::class)->name('request-product-info');



