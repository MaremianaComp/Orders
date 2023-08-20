<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('orders', [OrderController::class, 'index'])->name('orders');
Route::get('orders/create', [OrderController::class, 'create'])->name('order.create');
Route::post('orders', [OrderController::class, 'store'])->name('order.store');
Route::get('orders/{order}', [OrderController::class, 'show'])->name('order.show');
Route::patch('orders/{order}', [OrderController::class, 'update'])->name('order.update');
