<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend\pages\home');
});

Route::get('/story', [StoryController::class, 'index']);

Route::get('/about', function () {
    return view('frontend\pages\about');
});

Route::prefix('story')->group(function () {
    Route::get('/detail/{id}', [StoryController::class, 'show']);

    Route::get('add', [StoryController::class, 'create']);

    Route::patch('/store', [StoryController::class, 'store']);

    Route::patch('/update/{id}', [StoryController::class, 'update']);

    Route::delete('/delete/{id}', [StoryController::class, 'destroy']);
});

// Route::post('api/auth/login', [LoginController::class, 'login'])->name('api.auth.login');

Route::get('notfound', function(){
    return "Không có quyền truy cập";
})->name('notfound');