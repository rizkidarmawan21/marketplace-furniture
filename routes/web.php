<?php

use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/products',[ProductController::class, 'index'])->name('products.index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    require __DIR__.'/admin.php';
});

require __DIR__.'/auth.php';
