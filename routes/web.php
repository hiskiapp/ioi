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

// Products
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

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

    // Checkout
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');

    // Transactions
    Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/unpaid', [App\Http\Controllers\TransactionController::class, 'unpaid'])->name('transactions.unpaid');
    Route::get('/transactions/process', [App\Http\Controllers\TransactionController::class, 'process'])->name('transactions.process');
    Route::get('/transactions/shipping', [App\Http\Controllers\TransactionController::class, 'shipping'])->name('transactions.shipping');
    Route::get('/transactions/success', [App\Http\Controllers\TransactionController::class, 'success'])->name('transactions.success');
    Route::get('/transactions/expired', [App\Http\Controllers\TransactionController::class, 'expired'])->name('transactions.expired');
    Route::get('/transactions/{code}', [App\Http\Controllers\TransactionController::class, 'show'])->name('transactions.show');

    // Payment
    Route::get('/transactions/{code}/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment.index');
    Route::post('/transactions/{code}/payment', [App\Http\Controllers\PaymentController::class, 'store'])->name('payment.store');

    // Address
    Route::get('/address/{id}', [App\Http\Controllers\AddressController::class, 'show'])->name('address.show');
});
