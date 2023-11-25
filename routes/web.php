<?php

use App\DomainService\FilesExport;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestSocketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/{any}', function () {
//     return response()->json([
//         'message' => 'Something went wrong'
//     ], 400);
// })->where('any','.*');

// Route::get('/surveyExport/{id}', [FilesExport::class, 'surveyExport']);
// Route::post('/test-event', [TestSocketController::class, 'sendTestEvent']);

Route::get('/user', [UserController::class, 'show']);
Route::get('/event', [UserController::class, 'event']);
