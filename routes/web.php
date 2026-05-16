<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryCenterController;
use App\Http\Controllers\DriverWebController;
use App\Http\Controllers\OrderWebController;
use App\Http\Controllers\RouteWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('centers', DeliveryCenterController::class);
Route::resource('drivers', DriverWebController::class);
Route::resource('orders', OrderWebController::class);
Route::resource('routes', RouteWebController::class);
