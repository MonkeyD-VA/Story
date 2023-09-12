<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UserController;
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


Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('story')->group(function () {
        Route::get('/', [StoryController::class, 'index']);
        Route::get('detail/{id}', [StoryController::class, 'show']);
        Route::post('store', [StoryController::class, 'store']);
        Route::patch('update/{id}', [StoryController::class, 'update']);
        Route::delete('delete/{id}', [StoryController::class, 'destroy']);
        //Route::get('findPage/{id}', [StoryController::class, 'findPage']);
    });

    Route::prefix('page')->group(function () {
        Route::get('/', [PageController::class, 'index']);
        Route::get('story/{id}', PageController::class, '');
    });

});



// Route::get('logout', [UserController::class, 'logout']);