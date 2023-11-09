<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesExport;
use App\Filters\QuestionnairesFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionnairesRequest;
use App\Http\Requests\UpdateQuestionnairesRequest;
use App\Http\Resources\QuestionnairesResource;
use App\Models\Consultant;
use App\Models\Questionnaire;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuestionnairesController extends Controller
{

    public function index(QuestionnairesFilter $questionnairesFilter): JsonResource
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();

        return QuestionnairesResource::collection(Questionnaire::where('consultant_id', $consultant->id)->with('questions')->orderBy('updated_at', 'desc')->filter($questionnairesFilter)->paginate(6));
    }

    public function store(StoreQuestionnairesRequest $request): JsonResponse
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();
        $questionnaire = new Questionnaire();
        $fileUrl = config('filesystems.disks.public.url').'/consultants/questionnaires/'.Str::replace(' ', '_', $request->title).'_'.Carbon::now()->format('d.m.Y').'.xlsx';

        try {
            $questionnaire->title = $request->title;
            $questionnaire->description = $request->description;
            $questionnaire->answer_before = $request->answerBefore;
            $questionnaire->file_url = $fileUrl;
            $questionnaire->consultant_id = $consultant->id;
            $questionnaire->save();

            QuestionsController::store($request->questions, $questionnaire->id);

            FilesExport::surveyExport($fileUrl, $questionnaire->id);

            return response()->json([
                'message' => 'Questionnaire successfully added'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in QuestionnaireController.store'
            ], 400);
        }
    }

    public function show(int $id): JsonResource
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();

        return QuestionnairesResource::collection(Questionnaire::where('id', $id)->where('consultant_id', $consultant->id)->with('questions')->get());

    }

    public function update(UpdateQuestionnairesRequest $request, int $id): JsonResponse
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();
        $questionnaire = Questionnaire::where('id', $id)->where('consultant_id', $consultant->id)->with('questions')->first();

        $fileUrl = config('filesystems.disks.public.url').'/consultants/questionnaires/'.Str::replace(' ', '_', $request->title).'_'.Carbon::now()->format('d.m.Y').'.xlsx';
        try {
            $questionnaire->title = $request->title;
            $questionnaire->description = $request->description;
            $questionnaire->answer_before = $request->answerBefore;
            $questionnaire->consultant_id = $consultant->id;
            $questionnaire->save();

            QuestionsController::update($request->questions, $questionnaire->id);

            FilesExport::surveyExport($fileUrl, $questionnaire->id);

            return response()->json([
                'message' => 'Questionnaire successfully updated'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in QuestionnaireController.update'
            ], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            Questionnaire::destroy($id);
            return response()->json([
                'message' => 'Questionnaire successfully deleted'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in QuestionnairesController.destroy'
            ], 400);
        }
    }
}
