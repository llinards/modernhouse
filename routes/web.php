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
  Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'] );
  Route::get('/admin/create', [\App\Http\Controllers\AdminController::class, 'createProduct'] );
  Route::post('/admin', [\App\Http\Controllers\AdminController::class, 'storeProduct'] );
  Route::get('/admin/{product:slug}/edit', [\App\Http\Controllers\AdminController::class, 'showProduct'] );
});

Route::get('/', [\App\Http\Controllers\ProductsController::class, 'index']);
Route::get('/{product:slug}', [\App\Http\Controllers\ProductsController::class, 'show']);
Route::post('/{product:slug}', [\App\Http\Controllers\ProductsController::class, 'requestProductInfo'])->middleware(ProtectAgainstSpam::class)->name('request-product-info');

