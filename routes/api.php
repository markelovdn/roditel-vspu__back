<?php

use App\Http\Controllers\Api\ConsultantAnswersController;
use App\Http\Controllers\Api\ConsultantReportsController;
use App\Http\Controllers\Api\ConsultantsController;
use App\Http\Controllers\Api\ParentedQuestionsController;
use App\Http\Controllers\Api\ProfessionsController;
use App\Http\Controllers\Api\SpecizlizationsController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\VebinarsController;
use App\Models\Vebinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
    return 'test worked';
});

Route::post('/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\Auth\AuthController::class, 'register']);
Route::apiResource("/specializations", SpecizlizationsController::class);
Route::apiResource("/professions", ProfessionsController::class);
Route::apiResource("/consultants", ConsultantsController::class);
Route::apiResource("/vebinars", VebinarsController::class);

Route::apiResource("/parentedQuestions", ParentedQuestionsController::class);
Route::apiResource("/consultantAnswers", ConsultantAnswersController::class);
Route::apiResource("/consultantReports", ConsultantReportsController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("/users", UsersController::class);
    Route::apiResource("/consultantReports", ConsultantReportsController::class);
  });
