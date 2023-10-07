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
use Illuminate\Support\Facades\Route;

//AUTH
Route::post('/login', [AuthController::class, 'login']); //S
Route::post('/register', [AuthController::class, 'register']); //S

//COLLECTIONS
Route::apiResource("/specializations", SpecializationsController::class)->only('index'); //S
Route::apiResource("/professions", ProfessionsController::class)->only('index'); //S
Route::apiResource("/regions", RegionsController::class);

//CONSULTANTS
Route::apiResource("/consultants", ConsultantsController::class)->except('store', 'update', 'destroy'); //S

//WEBINARS
Route::apiResource("/webinars", WebinarsController::class)->except('store', 'update', 'destroy'); //S
Route::get("/webinarLectors", [WebinarsController::class, 'getWebinarLectors']); //S
Route::apiResource("/webinarCategories", WebinarCategoriesController::class)->except(['store','update', 'destroy']); //S
Route::apiResource("/webinarsQuestions", WebinarsQuestionsController::class);

Route::middleware('auth:sanctum')->group(function () {
    //TODO:добавить методы которые не должны быть доступны
    //TODO:проработать таблицу консультации на предмет завершения консультации
    Route::apiResource("/consultations", ConsultationsController::class);
    //TODO:продумать получение всех анкет в зависимости от консультанта и админам
    // Route::apiResource("/questionnaires", QuestionnairesController::class);
    Route::apiResource("/questionnaireParentedsAnswers", QuestionnaireParentedsAnswersController::class);
    Route::apiResource("/webinarPartisipants", WebinarPartisipantController::class);
    Route::post("/getUserByToken", [UsersController::class, 'getUserByToken']); //S
    Route::post('/logout', [AuthController::class, 'logout']); //S

    Route::middleware('consultant')->group(function () {
        Route::apiResource("/questionnaires", QuestionnairesController::class);
        Route::apiResource("/consultationMessages", ConsultationMessagesController::class);
        Route::apiResource("/consultants", ConsultantsController::class)->except('index', 'show', 'destroy'); //S
        Route::apiResource("/consultant.reports", ConsultantReportsController::class)->shallow(); //S
    });

    Route::middleware('parented')->group(function () {
        Route::apiResource("/parenteds", ParentedsController::class)->except('destroy');
        Route::apiResource("/parented.children", ChildrensController::class)->shallow(); //S
        Route::apiResource("/questionnaires", QuestionnairesController::class);
        Route::apiResource("/consultationMessages", ConsultationMessagesController::class);
    });

    Route::middleware('admin')->group(function () {
        Route::apiResource("/users", UsersController::class);
        Route::apiResource("/parenteds", ParentedsController::class)->except(['store', 'update']);
        Route::apiResource("/webinars", WebinarsController::class)->except('index', 'show'); //S
        Route::apiResource("/webinarCategories", WebinarCategoriesController::class)->except(['index','show']); //S
        Route::apiResource("/consultants", ConsultantsController::class)->only('destroy'); //S
        Route::apiResource("/specializations", SpecializationsController::class)->except('index'); //S
        Route::apiResource("/professions", ProfessionsController::class)->except('index'); //S

    });
});

//TODO:реализовать оценку качества консультаций


Route::get('/api/documentation', function() {
    return view('vendor.l5-swagger.index');
});


