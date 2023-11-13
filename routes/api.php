<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ChildrensController;
use App\Http\Controllers\Api\ConsultantContractController;
use App\Http\Controllers\Api\ConsultantReportsController;
use App\Http\Controllers\Api\ConsultantsController;
use App\Http\Controllers\Api\ConsultationCategoryController;
use App\Http\Controllers\Api\ConsultationMessagesController;
use App\Http\Controllers\Api\ConsultationsController;
use App\Http\Controllers\Api\LectorController;
use App\Http\Controllers\Api\ParentedsController;
use App\Http\Controllers\Api\ProfessionsController;
use App\Http\Controllers\Api\QuestionnairesController;
use App\Http\Controllers\Api\RegionsController;
use App\Http\Controllers\Api\SelectedOptionController;
use App\Http\Controllers\Api\SpecializationsController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\WebinarCategoriesController;
use App\Http\Controllers\Api\WebinarPartisipantController;
use App\Http\Controllers\Api\WebinarQuestionsController;
use App\Http\Controllers\Api\WebinarsController;
use App\Http\Controllers\Api\WebinarProgramController;
use Illuminate\Support\Facades\Route;

//TODO:проработать таблицу консультации на предмет завершения консультации
//TODO:реализовать оценку качества консультаций

//AUTH
Route::post('/login', [AuthController::class, 'login']); //S
Route::post('/register', [AuthController::class, 'register']); //S
Route::post('/logout', [AuthController::class, 'logout']); //S

//COLLECTIONS
Route::apiResource("/specializations", SpecializationsController::class)->only('index'); //S
Route::apiResource("/professions", ProfessionsController::class)->only('index'); //S
Route::apiResource("/regions", RegionsController::class)->only('index'); //S

//CONSULTANTS
Route::apiResource("/consultants", ConsultantsController::class)->only('index'); //S

//WEBINARS
Route::apiResource("/webinars", WebinarsController::class)->except('store', 'update', 'destroy'); //S
Route::apiResource("/webinar.webinarQuestions", WebinarQuestionsController::class)->shallow()->only('index', 'show'); //S
Route::apiResource("/lectors", LectorController::class)->only('index', 'show');
Route::get("/webinarLectors", [WebinarsController::class, 'getWebinarLectors']); //S
Route::apiResource("/webinarCategories", WebinarCategoriesController::class)->only('index', 'show'); //S

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("/users", UsersController::class)->only('update', 'show'); //S
    Route::get("/getUserByToken", [UsersController::class, 'getUserByToken']); //S
    Route::apiResource("/webinar.webinarPartisipants", WebinarPartisipantController::class)->shallow()->only('store', 'destroy');
    Route::apiResource("/users.consultations", ConsultationsController::class)->shallow()->except('dstroy');
    Route::apiResource("/consultations.messages", ConsultationMessagesController::class)->shallow();
    Route::apiResource("consultationCategories", ConsultationCategoryController::class)->only('index');

    Route::middleware('parented')->group(function () {
        Route::apiResource("/parenteds", ParentedsController::class)->only('update', 'show'); //S
        Route::apiResource("/parented.children", ChildrensController::class)->shallow(); //S
        Route::apiResource("/question.selectedOptions", SelectedOptionController::class)->shallow()->except('index'); //S
    });

    Route::middleware('consultant')->group(function () {
        Route::apiResource("/consultants", ConsultantsController::class)->except('index', 'destroy'); //S
        Route::post("/uploadPhotoConsultant", [ConsultantsController::class, 'uploadPhoto']);
        Route::apiResource("/consultant.reports", ConsultantReportsController::class)->shallow(); //S
        Route::apiResource("/consultant.questionnaires", QuestionnairesController::class)->shallow();
    });

    Route::middleware('admin')->group(function () {
        Route::apiResource("/users", UsersController::class)->except('update', 'show'); //S
        Route::apiResource("/parenteds", ParentedsController::class)->only('index', 'destroy'); //S
        Route::apiResource("/consultants", ConsultantsController::class)->only('destroy'); //S
        Route::apiResource("/webinars", WebinarsController::class)->except('index', 'show'); //S
        Route::apiResource("/webinar.webinarQuestions", WebinarQuestionsController::class)->shallow()->except('index', 'show'); //S
        Route::apiResource("/webinar.webinarPrograms", WebinarProgramController::class)->shallow()->except('index', 'show');
        Route::apiResource("/lectors", LectorController::class)->except('index', 'show');
        Route::apiResource("/webinar.webinarPartisipants", WebinarPartisipantController::class)->shallow()->except('store', 'destroy');
        Route::apiResource("/webinarCategories", WebinarCategoriesController::class)->except('index', 'show'); //S
        Route::apiResource("/specializations", SpecializationsController::class)->except('index'); //S
        Route::apiResource("/professions", ProfessionsController::class)->except('index'); //S
        Route::apiResource("/regions", RegionsController::class)->except('index'); //S
        Route::apiResource("/contracts", ConsultantContractController::class);

    });
});

Route::get('/api/documentation', function () {
    return view('vendor.l5-swagger.index');
});

Route::post('/forgotPassword', [AuthController::class, 'sendToken']);
Route::post('/resetPassword', [AuthController::class, 'resetPassword']);
