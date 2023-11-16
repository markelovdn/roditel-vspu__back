<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateParentedsRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Http\Resources\ParentedsResource;
use App\Models\Parented;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ParentedsController extends Controller
{

    public function index(): JsonResource
    {
        return ParentedsResource::collection(Parented::with('childrens', 'user')->get());
    }

    public function store()
    {
        //Родитель создается в методе $user->registrationAs(Auth::user(), $request);
    }

    public function show(int $id): JsonResource | JsonResponse
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();

        if ($parented->id != $id) {
            return response()->json([
                'message' => 'You have\'t permissions'
            ], 400);
        }

        return ParentedsResource::collection(Parented::where('id', $id)->get());
    }

    public function update(UpdateParentedsRequest $request, int $id): JsonResponse
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();

        if ($parented->id != $id) {
            return response()->json([
                'message' => 'You have\'t permissions'
            ], 400);
        }

        try {
            $parented->region_id = $request->regionId;
            $parented->save();

            return response()->json([
                'message' => 'Parent successfully updated'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in ParentedController.update'
            ], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            Parented::destroy($id);
            return response()->json([
                'message' => 'Parent successfully deleted'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in ParentedController.destroy'
            ], 400);
        }
    }
}
