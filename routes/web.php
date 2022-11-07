<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MouserController;
use App\Http\Controllers\dashboard\DashboardController;

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

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard.index') ;
});

Route::controller(MouserController::class)->group(function () {
    Route::get('mouser', 'index')->name('mouser.index');
    Route::get('mouser/keywordSearch', 'getFormKeywordSearch')->name('mouser.keywordSearch');
    Route::post('mouser/keywordSearch', 'postFormKeywordSearch')->name('mouser.keywordSearch');
});
