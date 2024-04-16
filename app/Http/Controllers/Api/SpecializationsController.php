<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecializationsRequest;
use App\Http\Resources\SpecializationsResource;
use App\Models\Specialization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Ramsey\Uuid\Type\Integer;

class SpecializationsController extends Controller
{

    public function index(): JsonResource
    {
        return SpecializationsResource::collection(Specialization::get());
    }

    public function store(StoreSpecializationsRequest $request): JsonResponse
    {
        $specialization = new Specialization();
        try {
            $specialization->title = $request->title;
            $specialization->save();

            return response()->json([
                'message' => 'Specialization successfully added'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in SpecializationsController.store'
            ], 400);
        }
    }

    public function show(int $id): JsonResource
    {
        return SpecializationsResource::collection(Specialization::where('id', $id)->get());
    }

    public function update(StoreSpecializationsRequest $request, int $id)
    {
        $specialization = Specialization::where('id', $id)->first();
        try {
            $specialization->title = $request->title;
            $specialization->save();

            return response()->json([
                'message' => 'Specialization successfully updated'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in SpecializationsController.update'
            ], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            Specialization::destroy($id);
            return response()->json([
                'message' => 'Specialization successfully deleted'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in SpecializationsController.destroy'
            ], 400);
        }
    }
}
