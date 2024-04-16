<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildrensRequest;
use App\Http\Requests\UpdateChildrensRequest;
use App\Http\Resources\ChildrensResource;
use App\Models\Children;
use App\Models\Parented;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ChildrensController extends Controller
{
    public function index(): JsonResource
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();

        return ChildrensResource::collection(Children::where('parented_id', $parented->id)->get());
    }

    public function store(StoreChildrensRequest $request): JsonResponse
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();

        if (Children::isAdult($request->age) || Parented::maxChildrens($parented->id)) {
            return response()->json([
                'message' => 'Возраст ребенка не может быть меньше 18, количество детей не может превышать ' . Parented::MAX_QUANTITY_CHILDRENS
            ], 400);
        }

        try {
            Children::newChildren($request, $parented->id);
        } catch (\Exception) {
            return response()->json([
                'message' => 'Something went wrong in ChildrensController.store'
            ], 400);
        }

        return response()->json([
            'message' => 'Children successfully added for parent'
        ]);
    }

    public function show(int $id)
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();

        return ChildrensResource::collection(Children::where(['id' => $id, 'parented_id' => $parented->id])->get());
    }

    public function update(UpdateChildrensRequest $request, string $id)
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();

        try {
            Children::updateChildren(Children::where(['id' => $id, 'parented_id' => $parented->id])->first(), $request);
        } catch (\Exception) {
            return response()->json([
                'message' => 'Something went wrong in ChildrensController.update'
            ], 400);
        }

        return response()->json([
            'message' => 'Children data successfully update'
        ]);
    }

    public function destroy(string $id)
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();
        try {
            Children::deleteChildren($id, $parented->id);
        } catch (\Exception) {
            return response()->json([
                'message' => 'Something went wrong in ChildrensController.destroy'
            ], 400);
        }

        return response()->json([
            'message' => 'Record children successfully deleted'
        ]);
    }
}
