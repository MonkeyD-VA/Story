<?php

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

Route::get('/', function(){
    return view('frontend\pages\home');
});

Route::get('/story', [StoryController::class, 'index']);

Route::get('/about', function(){
    return view('frontend\pages\about');
});

Route::get('/story/detail/{id}', [StoryController::class, 'show']);

Route::get('/story/add', [StoryController::class, 'create']);

Route::patch('/story/store', [StoryController::class, 'store']);

Route::patch('/story/update/{id}', [StoryController::class, 'update']);

Route::delete('/story/delete/{id}', [StoryController::class, 'destroy']);