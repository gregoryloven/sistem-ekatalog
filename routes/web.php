<?php

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

Route::get('/', function () {
    return view('home.index');
});

Auth::routes();

route::middleware(['auth'])->group(function () {
    Route::resource('product', ProductController::class);
    Route::post('/product/EditForm', [ProductController::class, 'EditForm'])->name('product.EditForm');
});

Route::get('/purchase-request/cariProduk', [App\Http\Controllers\PurchaseRequestController::class, 'cariProduk']);

Route::resource('purchase-request', PurchaseRequestController::class);

Route::get('/home', 'HomeController@index')->name('home');
