<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebinarCategoriesRequest;
use App\Http\Requests\StoreWebinarRequest;
use App\Http\Resources\WebinarCategoriesResource;
use App\Models\Webinar;
use App\Models\WebinarCategory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Expr\Cast\Object_;

class WebinarCategoriesController extends Controller
{

    public function index(): JsonResource
    {
        return WebinarCategoriesResource::collection(WebinarCategory::get());
    }

    public function store(StoreWebinarCategoriesRequest $request): JsonResponse
    {
        $webinarCategories = new WebinarCategory();

        try
        {
            $webinarCategories->title = $request->title;
            $webinarCategories->save();

            return response()->json([
                'message' => 'Webinar category successfully added'
            ], 200);

        }
        catch (Exception $e)
        {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in WebinarCategoriesController.store'
            ], 400);
        }
    }

    public function show(int $id): JsonResource
    {
        return WebinarCategoriesResource::collection(Webinar::where('id', $id)->get());
    }

    public function update(StoreWebinarCategoriesRequest $request, int $id): JsonResponse
    {
        $webinarCategories = Webinar::find($id);

        try
        {
            $webinarCategories->title = $request->title;
            $webinarCategories->save();

            return response()->json([
                'message' => 'Webinar category successfully update'
            ], 200);

        }
        catch (Exception $e)
        {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in WebinarCategoriesController.update'
            ], 400);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        $webinarCategories = WebinarCategory::find($id);

        try
        {
            $webinarCategories->delete();

            return response()->json([
                'message' => 'Webinar category successfully delete'
            ], 200);

        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'The entry cannot be deleted'
            ], 400);
        }
    }
}
