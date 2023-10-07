<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Resources\RegionsResource;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionsController extends Controller
{

    public function index()
    {
        return RegionsResource::collection(Region::get());
    }


    public function store(StoreRegionRequest $request): JsonResponse
    {
        $region = new Region();
        try {
            $region->code = $request->code;
            $region->title = $request->title;
            $region->save();

            return response()->json([
                'message' => 'Region successfully added'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in RegionController.store'
            ], 400);
        }
    }

    public function show(int $id): JsonResource
    {
        return RegionsResource::collection(Region::where('id', $id)->get());
    }

    public function update(StoreRegionRequest $request, int $id)
    {
        $region = Region::where('id', $id)->first();
        try {
            $region->code = $request->title;
            $region->title = $request->title;
            $region->save();

            return response()->json([
                'message' => 'Region successfully updated'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in RegionController.update'
            ], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            Region::destroy($id);
            return response()->json([
                'message' => 'Region successfully deleted'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in RegionsController.destroy'
            ], 400);
        }
    }
}
