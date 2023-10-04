<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ChildrensController;
use App\Http\Controllers\Api\ConsultantReportsController;
use App\Http\Controllers\Api\ConsultantsController;
use App\Http\Controllers\Api\ConsultationMessagesController;
use App\Http\Controllers\Api\ConsultationsController;
use App\Http\Controllers\Api\ParentedsController;
use App\Http\Controllers\Api\ProfessionsController;
use App\Http\Controllers\Api\QuestionnaireParentedsAnswersController;
use App\Http\Controllers\Api\QuestionnairesController;
use App\Http\Controllers\Api\RegionsController;
use App\Http\Controllers\Api\SpecializationsController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\WebinarCategoriesController;
use App\Http\Controllers\Api\WebinarPartisipantController;
use App\Http\Controllers\Api\WebinarsController;
use App\Http\Controllers\Api\WebinarsQuestionsController;
use App\Models\WebinarCategory;
use Illuminate\Support\Facades\Route;

// Route::get('/test', function() {
//     return 'test worked';
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::apiResource("/specializations", SpecializationsController::class);
Route::apiResource("/professions", ProfessionsController::class);
Route::apiResource("/regions", RegionsController::class);
Route::apiResource("/consultants", ConsultantsController::class);
Route::apiResource("/webinars", WebinarsController::class)->except('store', 'update', 'destroy');
Route::get("/webinarLectors", [WebinarsController::class, 'getWebinarLectors']);
Route::apiResource("/webinarCategories", WebinarCategoriesController::class)->except(['store','update', 'destroy']);
Route::apiResource("/webinarsQuestions", WebinarsQuestionsController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("/consultations", ConsultationsController::class);
    Route::apiResource("/questionnaireParentedsAnswers", QuestionnaireParentedsAnswersController::class);
    Route::apiResource("/webinarPartisipants", WebinarPartisipantController::class);

    Route::middleware('consultant')->group(function () {
        Route::apiResource("/consultantReports", ConsultantReportsController::class);
        Route::apiResource("/questionnaires", QuestionnairesController::class);
        Route::apiResource("/consultationMessages", ConsultationMessagesController::class);
    });

    Route::middleware('parented')->group(function () {
        Route::apiResource("/parenteds", ParentedsController::class)->except(['index']);
        Route::apiResource("/parented.children", ChildrensController::class);
        Route::apiResource("/questionnaires", QuestionnairesController::class);
        Route::apiResource("/consultationMessages", ConsultationMessagesController::class);
    });

    Route::middleware('admin')->group(function () {
        Route::apiResource("/users", UsersController::class);
        Route::apiResource("/parenteds", ParentedsController::class)->except(['store', 'update']);
        Route::apiResource("/webinars", WebinarsController::class)->except('index', 'show');
        Route::apiResource("/webinarCategories", WebinarCategoriesController::class)->except(['index','show']);
    });
});

Route::get('/api/documentation', function() {
    return view('vendor.l5-swagger.index');
});
