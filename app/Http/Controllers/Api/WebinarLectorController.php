<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebinarLectorRequest;
use App\Http\Requests\UpdateWebinarLectorRequest;
use App\Http\Resources\WebinarLectorResource;
use App\Models\WebinarLector;
use Illuminate\Http\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebinarLectorController extends Controller
{
    public function index($id): JsonResource
    {
        return WebinarLectorResource::collection(WebinarLector::where('webinar_id', $id)->get());
    }

    public function store(StoreWebinarLectorRequest $request, $webinarId, FilesHandler $filesHandler): JsonResponse
    {
        if ($request->hasFile('lectorPhoto')) {
            $lectorPhoto = $filesHandler->uploadLectorPhoto($request->lectorPhoto, $request->lectorName);
        } else {
            $lectorPhoto = "";
        }

        $webinarLector = new WebinarLector();
        try {
            $webinarLector->lector_name = $request->lectorName;
            $webinarLector->lector_description = $request->lectorDescription;
            $webinarLector->lector_department = $request->lectorDepartment;
            $webinarLector->lector_photo = $lectorPhoto;
            $webinarLector->webinar_id = $webinarId;
            $webinarLector->save();

            return response()->json([
                'message' => 'WebinarLector successfully added'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in WebinarLectorController.store'
            ], 400);
        }
    }

    public function show(int $id): JsonResource
    {
        return WebinarLectorResource::collection(WebinarLector::where('id', $id)->get());
    }

    public function update(UpdateWebinarLectorRequest $request, int $id, FilesHandler $filesHandler): JsonResponse
    {
        if ($request->hasFile('lectorPhoto')) {
            $lectorPhoto = $filesHandler->uploadLectorPhoto($request->lectorPhoto, $request->lectorName);
        } else {
            $lectorPhoto = "";
        }

        $webinarLector = WebinarLector::where('id', $id)->first();
        try {
            $webinarLector->lector_name = $request->lectorName;
            $webinarLector->lector_description = $request->lectorDescription;
            $webinarLector->lector_department = $request->lectorDepartment;
            $webinarLector->lector_photo = $lectorPhoto;
            $webinarLector->save();

            return response()->json([
                'message' => 'WebinarLector successfully update'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in WebinarLectorController.update'
            ], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            WebinarLector::destroy($id);
            return response()->json([
                'message' => 'WebinarLector successfully deleted'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in WebinarLectorController.destroy'
            ], 400);
        }
    }
}
