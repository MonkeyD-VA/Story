<?php

use App\Http\Controllers\api\StoryController;
use App\Http\Controllers\Api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);
// Route::get('/user', [UserController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('story/detail/{id}', [StoryController::class, 'show']);
    Route::patch('story/update/{id}', [StoryController::class, 'update']);
    Route::get('findPage/{id}', [StoryController::class, 'findPage']);
});

Route::middleware('admin')->group(function(){
    Route::get('getUser', function(){
        return "has get user from token";
    });
});


Route::get('logout', [UserController::class, 'logout']);