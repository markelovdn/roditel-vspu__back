<?php

use App\Http\Controllers\Api\Auth\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
    return 'test worked';
});

Route::post('/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\Auth\AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('get', function() {
        return '123';
    });

    Route::apiResource("/users", UsersController::class);
  });
