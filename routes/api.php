<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ConsultantAnswersController;
use App\Http\Controllers\Api\ConsultantReportsController;
use App\Http\Controllers\Api\ConsultantsController;
use App\Http\Controllers\Api\ConsultationMessagesController;
use App\Http\Controllers\Api\ConsultationsController;
use App\Http\Controllers\Api\ParentedQuestionsController;
use App\Http\Controllers\Api\ProfessionsController;
use App\Http\Controllers\Api\QuestionnaireParentedsAnswersController;
use App\Http\Controllers\Api\QuestionnairesController;
use App\Http\Controllers\Api\SpecizlizationsController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\VebinarsController;
use Illuminate\Support\Facades\Route;

// Route::get('/test', function() {
//     return 'test worked';
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::apiResource("/specializations", SpecizlizationsController::class);
Route::apiResource("/professions", ProfessionsController::class);
Route::apiResource("/consultants", ConsultantsController::class);
Route::apiResource("/vebinars", VebinarsController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("/users", UsersController::class);
    Route::apiResource("/consultations", ConsultationsController::class);
    Route::apiResource("/questionnaireParentedsAnswers", QuestionnaireParentedsAnswersController::class);

    Route::middleware('consultant')->group(function () {
        Route::apiResource("/consultantReports", ConsultantReportsController::class);
        Route::apiResource("/questionnaires", QuestionnairesController::class);
        Route::apiResource("/consultationMessages", ConsultationMessagesController::class);
    });
});
