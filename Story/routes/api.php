<?php

use App\Http\Controllers\StoryController;
use Illuminate\Http\Request;
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

Route::get('/story', [StoryController::class, 'index']);

Route::prefix('story')->group(function () {
    Route::get('/detail/{id}', [StoryController::class, 'show']);

    Route::get('add', [StoryController::class, 'create']);

    Route::patch('/store', [StoryController::class, 'store']);

    Route::patch('/update/{id}', [StoryController::class, 'update']);

    Route::delete('/delete/{id}', [StoryController::class, 'destroy']);
});