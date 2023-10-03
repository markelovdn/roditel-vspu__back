<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildrensRequest;
use App\Http\Requests\UpdateChildrensRequest;
use App\Http\Resources\ParentedsResource;
use App\Models\Children;
use App\Models\Parented;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildrensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();
        $childrens = Children::where('parented_id', $parented->id)->get();

        if (count($childrens) == 0) {
            return response()->json([
                'message' => 'You don\'t have any children added'
            ], 200);
        }

        return response()->json([ 'childrens' => json_decode(json_encode((object) $childrens[0]), FALSE) ], 200);

    }

    public function store(StoreChildrensRequest $request): JsonResponse
    {
        if ($request->age >= 18 ||
            count(Children::where('parented_id', $request->parented_id)->get()) > Parented::MAX_QUANTITY_CHILDRENS)
        {
            return response()->json([
                'error' => 'The child\'s age is not suitable for adding, or the number of added children is more than six'
            ], 300);
        }

        $children = new Children();

        try {
            $children->age = $request->age;
            $children->parented_id = $request->parented_id;

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $children = Children::where('parented_id', $id)->get();

        if (count($children) < 1)
        {
            return response()->json([
                'message' => 'You don\'t have any children added'
            ], 200);
        }
        return response()->json([ 'children' => $children ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildrensRequest $request, string $id)
    {
        $children = Children::where('parented_id', $id)->first();

        try {
            $children->age = $request->age;
            $children->parented_id = $request->parented_id;

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $id = Children::where('parented_id', $id)->first()->id;
            Children::destroy($id);
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
