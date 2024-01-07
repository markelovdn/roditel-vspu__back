<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ChildrensController;
use App\Http\Controllers\Api\ConsultantContractController;
use App\Http\Controllers\Api\ConsultantReportsController;
use App\Http\Controllers\Api\ConsultantsController;
use App\Http\Controllers\Api\ConsultationCategoryController;
use App\Http\Controllers\Api\ConsultationMessagesController;
use App\Http\Controllers\Api\ConsultationRatingController;
use App\Http\Controllers\Api\ConsultationsController;
use App\Http\Controllers\Api\LectorController;
use App\Http\Controllers\Api\NotificationController;
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

//AUTH
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/forgotPassword', [AuthController::class, 'sendToken']);
Route::post('/resetPassword', [AuthController::class, 'resetPassword']);

//COLLECTIONS
Route::apiResource("/specializations", SpecializationsController::class)->only('index');
Route::apiResource("/professions", ProfessionsController::class)->only('index');
Route::apiResource("/regions", RegionsController::class)->only('index');

//CONSULTANTS
Route::apiResource("/consultants", ConsultantsController::class)->only('index');

//WEBINARS
Route::apiResource("/webinars", WebinarsController::class)->except('store', 'update', 'destroy');
Route::apiResource("/webinar.webinarQuestions", WebinarQuestionsController::class)->shallow()->only('index', 'show');
Route::apiResource("/lectors", LectorController::class)->only('index', 'show');
Route::get("/webinarLectors", [WebinarsController::class, 'getWebinarLectors']);
Route::apiResource("/webinarCategories", WebinarCategoriesController::class)->only('index', 'show');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("/users", UsersController::class)->only('update', 'show');
    Route::get("/getUserByToken", [UsersController::class, 'getUserByToken']);
    Route::apiResource("/webinar.webinarPartisipants", WebinarPartisipantController::class)->shallow()->only('store', 'destroy');
    Route::apiResource("/users.consultations", ConsultationsController::class)->shallow()->except('dstroy');
    Route::apiResource("/consultations.messages", ConsultationMessagesController::class)->shallow();
    Route::apiResource("consultationCategories", ConsultationCategoryController::class)->only('index');
    Route::apiResource("/consultant.questionnaires", QuestionnairesController::class)->shallow()->except('update', 'store', 'destroy');
    Route::get("/getRatingCollection", [ConsultationRatingController::class, 'getRatingCollection']);
    Route::apiResource("/notifications", NotificationController::class);


    Route::middleware('parented')->group(function () {
        Route::apiResource("/parenteds", ParentedsController::class)->only('update', 'show');
        Route::apiResource("/parented.children", ChildrensController::class)->shallow();
        Route::apiResource("/questionnaire.selectedOptions", SelectedOptionController::class)->shallow()->only('index', 'store');
        Route::apiResource("/consultationRatings", ConsultationRatingController::class)->only('store');
        Route::get("/getRatingQuestions", [ConsultationRatingController::class, 'getRatingCollection']);
        Route::post('/getAllConsultantsForParented', [ConsultationsController::class, 'getAllConsultantsForParented']);
        Route::post("/downloadSertificate", [WebinarPartisipantController::class, 'downloadSertificate']);
    });

    Route::middleware('consultant')->group(function () {
        Route::apiResource("/consultants", ConsultantsController::class)->except('index', 'destroy');
        Route::post("/uploadPhotoConsultant", [ConsultantsController::class, 'uploadPhoto']);
        Route::apiResource("/consultant.reports", ConsultantReportsController::class)->shallow();
        Route::apiResource("/consultant.questionnaires", QuestionnairesController::class)->shallow()->only('update', 'store', 'destroy');
        Route::post('/setParentedToQuestionnaire', [QuestionnairesController::class, 'setParentedToQuestionnaire']);
        Route::post('/closeConsultation', [ConsultationsController::class, 'closeConsultation']);
        Route::post('/getAllParentedsForConsultant', [ConsultationsController::class, 'getAllParentedsForConsultant']);
    });

    Route::middleware('admin')->group(function () {
        Route::apiResource("/users", UsersController::class)->except('update', 'show');
        Route::apiResource("/parenteds", ParentedsController::class)->only('index', 'destroy');
        Route::apiResource("/consultants", ConsultantsController::class)->only('destroy');
        Route::apiResource("/webinars", WebinarsController::class)->except('index', 'show');
        Route::post("/webinar/{id}", [WebinarsController::class, 'update']);
        Route::apiResource("/webinar.webinarQuestions", WebinarQuestionsController::class)->shallow()->except('index', 'show');
        Route::apiResource("/webinar.webinarPrograms", WebinarProgramController::class)->shallow()->except('index', 'show');
        Route::apiResource("/lectors", LectorController::class)->except('index', 'show');
        Route::post("/updateLector/{id}", [LectorController::class, 'update']);
        Route::apiResource("/webinar.webinarPartisipants", WebinarPartisipantController::class)->shallow()->except('store', 'destroy');
        Route::post('/dowloadWebinarPartisipants', [WebinarPartisipantController::class, 'dowloadWebinarPartisipants']);
        Route::apiResource("/webinarCategories", WebinarCategoriesController::class)->except('index', 'show');
        Route::apiResource("/specializations", SpecializationsController::class)->except('index');
        Route::apiResource("/professions", ProfessionsController::class)->except('index');
        Route::apiResource("/regions", RegionsController::class)->except('index');
        Route::apiResource("/contracts", ConsultantContractController::class);
        Route::get("/getConsultantsForAdmin", [ConsultantsController::class, 'getConsultantsForAdmin']);
        Route::put("/updateContractNumber/{consultantId}", [ConsultantsController::class, 'updateContractNumber']);
        Route::get("/getConsultantsReports", [ConsultantReportsController::class, 'getConsultantsReports']);
    });
});

Route::get('/api/documentation', function () {
    return view('vendor.l5-swagger.index');
});
