<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Trenz\TrenzProductController;
use App\Http\Controllers\Plentymarket\PmVariationController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\Plentymarket\PmShopController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(TrenzProductController::class)->group(function () {
    Route::get('/trenz', 'index');
    Route::get('/trenz/upsert', 'updateOrInsert')->name('trenz-product.upsert');
});
Route::controller(PmVariationController::class)->group(function () {
    Route::get('/pm', 'index');
    Route::get('/pm/create', 'create')->name('pm-variation.create');
    Route::get('/pm/update', 'update')->name('pm-variation.update');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard.index') ;
});

Route::controller(PmShopController::Class)->group(function () {
    Route::get('/shop/update-price', 'updateSalesPrice')->name('shop.update-price') ;
    Route::get('/shop/update-stock', 'updateStock')->name('shop.update-stock') ;
});
