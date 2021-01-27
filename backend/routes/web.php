<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\AuthController;

// backend api
// -----------------------------------------------------------------------------
Route::prefix('api')->middleware('throttle:60,1')->group(function () {
  Route::get('/ping', fn() => 'pong ' . Carbon::now()->getTimestamp());

  Route::get('/user', [UserController::class, 'show']);
  Route::patch('/user', [UserController::class, 'update'])->middleware('auth');

  Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
  Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
  Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

  Route::get('/project', [ProjectController::class, 'show'])->middleware('auth');
  Route::patch('/project', [ProjectController::class, 'update'])->middleware('auth');
  Route::get('/projects', [ProjectController::class, 'index']);
  Route::post('/projects/{project}/vote', [ProjectController::class, 'vote'])->middleware('auth');
});

// frontend spa
// -----------------------------------------------------------------------------
Route::get('/{any}', fn() => File::get(public_path() . '/index.html'))->where('any', '.*');
