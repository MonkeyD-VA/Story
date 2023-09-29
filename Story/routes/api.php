<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\TouchController;
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
        Route::get('pageOf/{id}', [StoryController::class, 'findPage']);
    });

    Route::prefix('page')->group(function () {
        Route::get('/', [PageController::class, 'index']);
        Route::get('detail/{id}', [PageController::class, 'show']);
        Route::post('store', [PageController::class, 'store']);
        Route::patch('update/{id}', [PageController::class, 'update']);
        Route::delete('delete/{id}', [PageController::class, 'destroy']);
        Route::get('{story_id}/{page_number}', [PageController::class, 'getAllOfPage']);
    });

    Route::prefix('text')->group(function () {
        Route::get('/', [TextController::class, 'index']);
        Route::get('detail/{id}', [TextController::class, 'show']);
        Route::post('store', [TextController::class, 'store']);
        Route::patch('update/{id}', [TextController::class, 'update']);
        Route::delete('delete/{id}', [TextController::class, 'destroy']);
        Route::post('createByList', [TextController::class, 'updateTextInList']);
    });

    Route::prefix('touch')->group(function () {
        Route::get('/', [TouchController::class, 'index']);
        Route::get('detail/{id}', [TouchController::class, 'show']);
        Route::post('store', [TouchController::class, 'store']);
        Route::patch('update/{id}', [TouchController::class, 'update']);
        Route::delete('delete/{id}', [TouchController::class, 'destroy']);
    });

    // Route::prefix('textConfig')->group(function () {
    //     Route::get('/', [PageController::class, 'index']);
    //     Route::get('detail/{id}', [PageController::class, 'show']);
    //     Route::post('store', [PageController::class, 'store']);
    //     Route::patch('update/{id}', [PageController::class, 'update']);
    //     Route::delete('delete/{id}', [PageController::class, 'destroy']);
    // });

    Route::prefix('position')->group(function () {
        Route::get('/', [PositionController::class, 'index']);
        Route::get('detail/{id}', [PositionController::class, 'show']);
        Route::post('store', [PositionController::class, 'store']);
        Route::patch('update/{id}', [PositionController::class, 'update']);
        Route::delete('delete/{id}', [PositionController::class, 'destroy']);
        Route::get('page/{id}', [PositionController::class, 'getPositionInPage']);
        Route::post('create', [PositionController::class, 'createPositionByTouch']);
        Route::post('createWithNewText', [PositionController::class, 'createWithNewText']);
    });

    

});

