<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/test', function() {
//     return 'test worked';
// });

Route::post('/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\Auth\AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
