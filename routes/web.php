<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverWebController;
use App\Http\Controllers\OrderWebController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RouteWebController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Public Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Customer Storefront Routes
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::post('/cart/add', [ShopController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [ShopController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart', [ShopController::class, 'viewCart'])->name('cart.view');

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [ShopController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/checkout/success', [ShopController::class, 'success'])->name('checkout.success');
});

// Admin Dashboard Routes (Protected)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('drivers', DriverWebController::class);
    
    Route::resource('orders', OrderWebController::class);
    Route::post('/orders/{order}/status', [OrderWebController::class, 'updateStatus'])->name('orders.status');
    
    Route::resource('routes', RouteWebController::class);
    Route::resource('products', ProductController::class);
});

