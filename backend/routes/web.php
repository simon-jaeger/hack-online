<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Controllers\AuthController;

// backend api
// -----------------------------------------------------------------------------
Route::prefix('api')->middleware('throttle:120,1')->group(function () {
  Route::get('/ping', fn() => 'pong ' . Carbon::now()->getTimestamp());

  Route::get('/user', [UserController::class, 'show']);
  Route::patch('/user', [UserController::class, 'update']);

  Route::post('/register', [AuthController::class, 'register']);
  Route::post('/login', [AuthController::class, 'login']);
  Route::post('/logout', [AuthController::class, 'logout']);

  Route::get('/project', [ProjectController::class, 'show']);
  Route::patch('/project', [ProjectController::class, 'update']);
});

// frontend spa
// -----------------------------------------------------------------------------
Route::get('/{any}', fn() => File::get(public_path() . '/index.html'))->where('any', '.*');
