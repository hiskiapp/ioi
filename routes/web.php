<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('admin', function () {
    return redirect('admin/statistic_builder/dashboard');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // My Account
    Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account.index');
    Route::post('/account', [App\Http\Controllers\AccountController::class, 'update'])->name('account.update');

    // Cart
    ROute::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{products_id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/qty', [App\Http\Controllers\CartController::class, 'qty'])->name('cart.qty');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
});
