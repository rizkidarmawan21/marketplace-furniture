<?php

use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Main\AuthController;
use App\Http\Controllers\Main\CartController;
use App\Http\Controllers\Main\CheckoutController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\MyOrderController;
use App\Http\Controllers\Main\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('store');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','isAdmin'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::put('cart/update/{cart}', [CartController::class, 'update'])->name('cart.update');

    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('checkout/save-item', [CheckoutController::class, 'saveItemForCheckout'])->name('checkout.save-item');
    Route::post('checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [PasswordController::class, 'update'])->name('profile.password.update');
    Route::get('profile/orders', [MyOrderController::class, 'index'])->name('my-orders.index');
    Route::get('profile/orders/{transaction}', [MyOrderController::class, 'show'])->name('my-orders.show');
    Route::post('profile/orders/{transaction}/received', [MyOrderController::class, 'received'])->name('my-orders.received');
    
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    
    require __DIR__ . '/admin.php';
});

Route::get('checkout/payment-success', [CheckoutController::class, 'successPayment'])->name('checkout.finish');
Route::post('midtrans/callback', [MidtransController::class, 'callback']);
