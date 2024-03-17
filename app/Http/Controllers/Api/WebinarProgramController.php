<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebinarProgramRequest;
use App\Http\Requests\UpdateWebinarProgramRequest;
use App\Http\Resources\WebinarProgramResource;
use App\Models\WebinarProgram;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebinarProgramController extends Controller
{
    public function index($id): JsonResource
    {
        return WebinarProgramResource::collection(WebinarProgram::where('webinar_id', $id)->get());
    }

    public function store(StoreWebinarProgramRequest $request, $webinarId): JsonResponse
    {
        $webinarProgram = new WebinarProgram();
        try {
            $webinarProgram->time_start = $request->timeStart;
            $webinarProgram->subject = $request->subject;
            $webinarProgram->webinar_id = $webinarId;
            $webinarProgram->save();

            return response()->json([
                'message' => 'WebinarProgram successfully added'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in WebinarProgramsController.store'
            ], 400);
        }
    }

    public function show(int $id): JsonResource
    {
        return WebinarProgramResource::collection(WebinarProgram::where('id', $id)->get());
    }

    public function update(UpdateWebinarProgramRequest $request, int $id): JsonResponse
    {
        $webinarProgram = WebinarProgram::where('id', $id)->first();
        try {
            $webinarProgram->time_start = $request->timeStart;
            $webinarProgram->subject = $request->subject;
            $webinarProgram->save();

            return response()->json([
                'message' => 'WebinarProgram successfully update'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in WebinarProgramsController.update'
            ], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            WebinarProgram::destroy($id);
            return response()->json([
                'message' => 'WebinarProgram successfully deleted'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in WebinarProgramController.destroy'
            ], 400);
        }
    }
}
