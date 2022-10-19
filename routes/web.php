<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\ProductsController::class, 'index']);
Route::get('/{product:slug}', [\App\Http\Controllers\ProductsController::class, 'show']);
Route::post('/{product:slug}', [\App\Http\Controllers\ProductsController::class, 'requestProductInfo'])->name('request-product-info');

