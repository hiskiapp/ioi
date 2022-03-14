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

    // Products
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

    // Cart
    ROute::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{products_id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/qty', [App\Http\Controllers\CartController::class, 'qty'])->name('cart.qty');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');

    // Orders
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/unpaid', [App\Http\Controllers\OrderController::class, 'unpaid'])->name('orders.unpaid');
    Route::get('/orders/process', [App\Http\Controllers\OrderController::class, 'process'])->name('orders.process');
    Route::get('/orders/shipping', [App\Http\Controllers\OrderController::class, 'shipping'])->name('orders.shipping');
    Route::get('/orders/success', [App\Http\Controllers\OrderController::class, 'success'])->name('orders.success');
    Route::get('/orders/expired', [App\Http\Controllers\OrderController::class, 'expired'])->name('orders.expired');
    Route::get('/orders/{code}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');

    // Payment
    Route::get('/orders/{code}/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment.index');
    Route::post('/orders/{code}/payment', [App\Http\Controllers\PaymentController::class, 'store'])->name('payment.store');

    // Address
    Route::get('/address/{id}', [App\Http\Controllers\AddressController::class, 'show'])->name('address.show');
});
