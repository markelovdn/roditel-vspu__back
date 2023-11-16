<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesExport;
use App\Filters\QuestionnairesFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionnairesRequest;
use App\Http\Requests\StoreQuestionnairesToParentedRequest;
use App\Http\Requests\UpdateQuestionnairesRequest;
use App\Http\Resources\QuestionnairesResource;
use App\Models\Consultant;
use App\Models\Parented;
use App\Models\Questionnaire;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionnairesController extends Controller
{

    public function index(QuestionnairesFilter $questionnairesFilter): JsonResource
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();
        $parented = Parented::where('user_id', Auth::user()->id)->first();

        if ($parented) {
            $questionnaireId = DB::table('parented_questionnaire')->where('parented_id', $parented->id)->pluck('questionnaire_id');
            return QuestionnairesResource::collection(Questionnaire::whereIn('id', $questionnaireId)->with('questions')->orderBy('updated_at', 'desc')->filter($questionnairesFilter)->paginate(6));
        }

        return QuestionnairesResource::collection(Questionnaire::where('consultant_id', $consultant->id)->with('questions')->orderBy('updated_at', 'desc')->filter($questionnairesFilter)->paginate(6));
    }

    public function store(StoreQuestionnairesRequest $request): JsonResponse
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();
        $questionnaire = new Questionnaire();
        $fileUrl = config('filesystems.disks.public.url') . '/consultants/questionnaires/' . Str::replace(' ', '_', $request->title) . '_' . Carbon::now()->format('d.m.Y') . '.xlsx';

        try {
            $questionnaire->title = $request->title;
            $questionnaire->description = $request->description;
            $questionnaire->answer_before = Carbon::parse($request->answerBefore)->format('Y-m-d');
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
        $parented = Parented::where('user_id', Auth::user()->id)->first();

        if ($parented) {
            $questionnaireId = DB::table('parented_questionnaire')
                ->where('parented_id', $parented->id)
                ->where('questionnaire_id', $id)->pluck('questionnaire_id')->first();

            return QuestionnairesResource::collection(Questionnaire::where('id', $questionnaireId)->with('questions')->get());
        }
        return QuestionnairesResource::collection(Questionnaire::where('id', $id)->where('consultant_id', $consultant->id)->with('questions')->get());
    }

    public function update(UpdateQuestionnairesRequest $request, int $id): JsonResponse
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();
        $questionnaire = Questionnaire::where('id', $id)->where('consultant_id', $consultant->id)->with('questions')->first();

        $fileUrl = config('filesystems.disks.public.url') . '/consultants/questionnaires/' . Str::replace(' ', '_', $request->title) . '_' . Carbon::now()->format('d.m.Y') . '.xlsx';
        try {
            $questionnaire->title = $request->title;
            $questionnaire->description = $request->description;
            $questionnaire->answer_before = Carbon::parse($request->answerBefore)->format('Y-m-d');
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

    public function setParentedToQuestionnaire(StoreQuestionnairesToParentedRequest $request): JsonResponse
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();
        if (!$consultant) {
            return response()->json([
                'message' => 'Consultant not found'
            ], 400);
        }

        try {
            DB::table('parented_questionnaire')->insert([
                'parented_id' => $request->parentedId,
                'questionnaire_id' => $request->questionnaireId,
            ]);
            return response()->json([
                'message' => 'Questionnaire successfully added to parented'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in QuestionnairesController.setParentToQuesstionnaire'
            ], 400);
        }
    }
}
