<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionnairesRequest;
use App\Http\Resources\QuestionnairesResource;
use App\Models\Consultant;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class QuestionnairesController extends Controller
{

    public function index()
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();

        return QuestionnairesResource::collection(Questionnaire::where('consultant_id', $consultant->id)->with('questions')->paginate(6));

    }

    public function store(StoreQuestionnairesRequest $request): JsonResponse
    {
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();
        $questionnaire = new Questionnaire();
        try {
            $questionnaire->title = $request->title;
            $questionnaire->description = $request->description;
            $questionnaire->answer_before = $request->answerBefore;
            $questionnaire->consultant_id = $consultant->id;
            $questionnaire->save();
            
            $questionnaire->storeQuestions($request->questions, $questionnaire->id);

            return response()->json([
                'message' => 'Questionnaire successfully added'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in QuestionnaireController.store'
            ], 400);
        }
    }

    // public function show(int $id): JsonResource
    // {
    //     return RegionsResource::collection(Region::where('id', $id)->get());
    // }

    // public function update(StoreRegionRequest $request, int $id): JsonResponse
    // {
    //     $region = Region::where('id', $id)->first();
    //     try {
    //         $region->code = $request->title;
    //         $region->title = $request->title;
    //         $region->save();

    //         return response()->json([
    //             'message' => 'Region successfully updated'
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Something went wrong in RegionController.update'
    //         ], 400);
    //     }
    // }

    // public function destroy(int $id): JsonResponse
    // {
    //     try {
    //         Region::destroy($id);
    //         return response()->json([
    //             'message' => 'Region successfully deleted'
    //         ], 200);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Something went wrong in RegionsController.destroy'
    //         ], 400);
    //     }
    // }
}
