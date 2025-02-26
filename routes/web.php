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

// Route::get('/', function () {
//     return view('home.index');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

route::middleware(['auth'])->group(function () {
    Route::resource('product', ProductController::class);
    Route::post('/product/EditForm', [App\Http\Controllers\ProductController::class, 'EditForm'])->name('product.EditForm');
});

Route::get('/purchase-request/cariProduk', [App\Http\Controllers\PurchaseRequestController::class, 'cariProduk']);

Route::get('/purchase-details/{purchaseId}', [App\Http\Controllers\PurchaseRequestController::class, 'showPurchaseDetails']);

Route::put('/konfirmasi-pembayaran/{id}', [App\Http\Controllers\PurchaseRequestController::class, 'konfirmasiPembayaran'])->name('konfirmasi.pembayaran');

Route::put('/tolak-pembayaran/{id}', [App\Http\Controllers\PurchaseRequestController::class, 'tolakPembayaran'])->name('tolak.pembayaran');

Route::resource('purchase-request', PurchaseRequestController::class);
Route::resource('payment', PaymentController::class);
Route::get('/filter-payments', [App\Http\Controllers\PaymentController::class, 'filterPayments']);
Route::get('/payment-user', [App\Http\Controllers\PaymentController::class, 'indexUser']);


Route::get('/home', 'HomeController@index')->name('home');
