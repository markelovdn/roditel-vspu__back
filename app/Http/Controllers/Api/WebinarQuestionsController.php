<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebinarQuestionsRequests;
use App\Http\Resources\WebinarQuestionsResource;
use App\Models\WebinarQuestion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class WebinarQuestionsController extends Controller
{
    public function index($id): JsonResource
    {
        return WebinarQuestionsResource::collection(WebinarQuestion::where('webinar_id', $id)->get());
    }

    public function store(StoreWebinarQuestionsRequests $request, $webinarId): JsonResponse
    {
        $webinarQuestion = new WebinarQuestion();
        try {
            $webinarQuestion->question_text = $request->questionText;
            $webinarQuestion->webinar_id = $webinarId;
            $webinarQuestion->save();

            return response()->json([
                'message' => 'WebinarQuestion successfully added'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in WebinarQuestionsController.store'
            ], 400);
        }
    }

    public function show(int $id): JsonResource
    {
        return WebinarQuestionsResource::collection(WebinarQuestion::where('id', $id)->get());
    }

    public function update(StoreWebinarQuestionsRequests $request, int $id): JsonResponse
    {
        $webinarQuestion = WebinarQuestion::where('id', $id)->first();
        try {
            $webinarQuestion->question_text = $request->questionText;
            $webinarQuestion->save();

            return response()->json([
                'message' => 'WebinarQuestion successfully update'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in WebinarQuestionsController.update'
            ], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            WebinarQuestion::destroy($id);
            return response()->json([
                'message' => 'WebinarQuestion successfully deleted'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in WebinarQuestionController.destroy'
            ], 400);
        }
    }
}
