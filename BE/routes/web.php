<?php

use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\GameController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\EventController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrdersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route cho khu vực User
Route::namespace('App\Http\Controllers\User')->group(function () {
    Route::get('/', 'HomeController@index')->name('user.home');
    Route::get('/games', 'GameController@index')->name('games');
    Route::get('/contact', 'ContactController@index')->name('contact');
    Route::get('/event', 'EventController@index')->name('event');
    Route::get('/game-detail/{id}', 'GameController@detail')->name('game.detail');
    Route::get('/category/{category_id}', 'GameController@category')->name('category');
    Route::get('/cart', 'CartController@index')->middleware('auth')->name('cart');
    Route::post('/cart/add', 'CartController@add')->middleware('auth')->name('cart.add');;
    Route::get('/detailGames/{id}', 'GameController@show')->name('game.show');
    Route::post('/cart/remove/{id}', 'CartController@remove')->middleware('auth')->name('cart.remove');
    Route::get('/search', 'GameController@search')->name('search');
    Route::get('/search', 'GameController@search')->name('search');
    Route::get('/orders', 'OrdersController@index')->name('orders');
    Route::get('/orders/{id}', 'OrdersController@show')->name('orders.show');
})->middleware('role:user');

//payment
Route::post('/vnpay-payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay_payment');
Route::get('/vnpay-return', [PaymentController::class, 'vnpayReturn'])->name('vnpay_return');

// Route cho khu vực Admin
Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', 'HomeController@index')->name('admin.home');
    // Route::get('/games', 'GameController@index')->name('admin.games.index');
    // Route::get('/games/create', 'GameController@create')->name('admin.games.create');
});

// Route cho Dashboard
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware('auth')->name('dashboard');

// Route cho Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route xác thực của Breeze
require __DIR__.'/auth.php';
