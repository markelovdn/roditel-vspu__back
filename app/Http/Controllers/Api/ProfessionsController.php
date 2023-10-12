<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfessionsRequest;
use App\Http\Resources\ProfessionsResource;
use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionsController extends Controller
{

    public function index()
    {
        return ProfessionsResource::collection(Profession::get());
    }

    public function store(StoreProfessionsRequest $request)
    {
        $professions = new Profession();

        try {
            $professions->title = $request->title;
            $professions->save();

            return response()->json([
                'message' => 'Profession successfully added'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in ProfessionssController.store'
            ], 400);
        }
    }

    public function show(int $id)
    {
        return ProfessionsResource::collection(Profession::where('id', $id)->get());
    }

    public function update(StoreProfessionsRequest $request, int $id)
    {
        $professions = Profession::where('id', $id)->first();

        try {
            $professions->title = $request->title;
            $professions->save();

            return response()->json([
                'message' => 'Profession successfully updated'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in ProfessionssController.update'
            ], 400);
        }
    }

    public function destroy(int $id)
    {
        try {
            Profession::destroy($id);

            return response()->json([
                'message' => 'Profession successfully deleted'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in ProfessionssController.destroy'
            ], 400);
        }
    }
}
