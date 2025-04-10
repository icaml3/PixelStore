<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\GamesController;
use App\Http\Controllers\Admin\CateController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Games
Route::resource('games', GamesController::class);
Route::post('games/{id}/restore', [GamesController::class, 'restore']);
Route::post('games/{id}/force', [GamesController::class, 'forceDelete']);
//Category
Route::resource('category', CateController::class);
Route::post('category/{id}/restore', [CateController::class, 'restore']);
Route::post('category/{id}/force', [CateController::class, 'forceDelete']);


