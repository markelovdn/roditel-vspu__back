<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLectorRequest;
use App\Http\Requests\UpdateLectorRequest;
use App\Http\Resources\LectorResource;
use App\Models\Lector;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class LectorController extends Controller
{
    public function index(): JsonResource
    {
        return LectorResource::collection(Lector::get());
    }

    public function store(StoreLectorRequest $request, FilesHandler $filesHandler): JsonResponse
    {
        if ($request->hasFile('photo')) {
            $lectorPhoto = $filesHandler->uploadLectorPhoto($request->photo, $request->name);
        } else {
            $lectorPhoto = "";
        }

        $webinarLector = new Lector();
        try {
            $webinarLector->lector_name = $request->name;
            $webinarLector->lector_description = $request->description;
            $webinarLector->lector_department = $request->department;
            $webinarLector->lector_photo = $lectorPhoto;
            $webinarLector->save();

            return response()->json([
                'message' => 'Lector successfully added'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in LectorController.store'
            ], 400);
        }
    }

    public function show(int $id): JsonResponse
    {
        $lector = Lector::where('id', $id)->first();

        return response()->json([
            'id' => $lector->id,
            'lectorName' => $lector->lector_name,
            'lectorDescription' => $lector->lector_description,
            'lectorDepartment' => $lector->lector_department,
            'lectorPhotoURL' => $lector->lector_photo
        ], 200);
    }

    public function update(UpdateLectorRequest $request, int $id, FilesHandler $filesHandler): JsonResponse
    {
        if ($request->hasFile('photo')) {
            $lectorPhoto = $filesHandler->uploadLectorPhoto($request->photo, $request->name);
        } else {
            $lectorPhoto = "";
        }
        $webinarLector = Lector::where('id', $id)->first();
        try {
            $webinarLector->lector_name = $request->name;
            $webinarLector->lector_description = $request->description;
            $webinarLector->lector_department = $request->department;
            $webinarLector->lector_photo = $lectorPhoto;
            $webinarLector->save();

            return response()->json([
                'message' => 'Lector successfully update'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in LectorController.update'
            ], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            Lector::destroy($id);
            return response()->json([
                'message' => 'Lector successfully deleted'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in LectorController.destroy'
            ], 400);
        }
    }
}
