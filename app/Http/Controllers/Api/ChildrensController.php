<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildrensRequest;
use App\Http\Requests\UpdateChildrensRequest;
use App\Http\Resources\ChildrensResource;
use App\Http\Resources\ParentedsResource;
use App\Models\Children;
use App\Models\Parented;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

        if ($request->age >= 18 ||
            count(Children::where('parented_id', $parented->id)->get()) >= Parented::MAX_QUANTITY_CHILDRENS)
        {
            return response()->json([
                'error' => 'The child\'s age is not suitable for adding, or the number of added children is more than six'
            ], 300);
        }

        $children = new Children();

        try {
            $children->age = $request->age;
            $children->parented_id = $parented->id;

            $children->save();

            return response()->json([
                'message' => 'Children successfully added for parent'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ChildrensController.store'
            ], 400);
        }
    }

    public function show(int $id)
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();

        return ChildrensResource::collection(Children::where(['id'=> $id, 'parented_id' => $parented->id])->get());
    }

    public function update(UpdateChildrensRequest $request, string $id)
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();
        $children = Children::where(['id'=> $id, 'parented_id' => $parented->id])->first();

        try {
            $children->age = $request->age;

            $children->save();

            return response()->json([
                'message' => 'Children data successfully update'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ChildrensController.update'
            ], 400);
        }
    }

    public function destroy(string $id)
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();
        try {
            $children = Children::where(['id'=> $id, 'parented_id' => $parented->id])->first();
            Children::destroy($children->id);
            return response()->json([
                'message' => 'Record children successfully deleted'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ChildrensController.destroy'
            ], 400);
        }
    }
}
