<?php

use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Products\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/order', [CheckoutController::class, 'orders'])->name('orders');

Route::post('/order', [CheckoutController::class, 'store'])->name('order');
Route::get('/success', [CheckoutController::class, 'success'])->name('success');
Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('cancel');

require __DIR__ . '/auth.php';
