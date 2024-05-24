<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    require __DIR__ . '/auth.php';
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('auth');

    Route::resource('users', UserController::class)->middleware('auth');

    Route::resource('categories', CategoryController::class)->middleware('auth');

    Route::resource('products', ProductController::class)->middleware('auth');

    Route::resource('orders', OrderController::class)->middleware('auth');

    Route::resource('articles', ArticleController::class)->middleware('auth');
});
