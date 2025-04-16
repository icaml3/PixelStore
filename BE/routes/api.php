<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\GamesController;
use App\Http\Controllers\Admin\CateController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Các route yêu cầu xác thực và vai trò admin
Route::middleware(['api.auth:sanctum', 'roleadmin:admin'])->group(function () {
    // Games
    Route::resource('games', GamesController::class);
    Route::post('games/{id}/restore', [GamesController::class, 'restore']);
    Route::post('games/{id}/force', [GamesController::class, 'forceDelete']);

    // Category
    Route::resource('category', CateController::class);
    Route::post('category/{id}/restore', [CateController::class, 'restore']);
    Route::post('category/{id}/force', [CateController::class, 'forceDelete']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //Order
    Route::resource('order', OrderController::class);

    //User
    Route::resource('user', UserController::class);
});

// Các route công khai
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::get('/login', [AuthController::class, 'requestLogin'])->name('login');
