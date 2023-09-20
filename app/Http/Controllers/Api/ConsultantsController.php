<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultantRequest;
use App\Http\Requests\UpdateConsultantRequest;
use App\Http\Resources\ConsultantShowResource;
use App\Http\Resources\ConsultantsResource;
use App\Models\Consultant;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultantsController extends Controller
{
    public function index()
    {
        return ConsultantsResource::collection(Consultant::with('user', 'specialization', 'profession')->get());
    }

    public function store(StoreConsultantRequest $request, FilesHandler $filesHandler)
    {
        $role = new Role();

        $isConsultant = $role->isConsultant($request->user_id);

        if(!$isConsultant) {
            return response()->json(['error' => 'Access is denied'], 400);
        }

        $consultant = Consultant::where('user_id', $request->user_id)->first();

        try {
            $consultant->photo = $filesHandler->uploadPhoto($consultant->user_id, $request->photo);
            $consultant->description = $request->description;

            $consultant->save();

            return response()->json([
                'message' => 'Data successfully added'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ConsultantController.store'
            ], 400);
        }
    }

    public function show(string $id)
    {
        return ConsultantShowResource::collection(Consultant::where('id', $id)->with('user', 'specialization', 'profession')->get());
    }

    public function update(UpdateConsultantRequest $request, string $id, FilesHandler $filesHandler)
    {
        $role = new Role();
        $isConsultant = $role->isConsultant(Auth()->user()->id);

        if(!$isConsultant) {
            return response()->json(['error' => 'Access is denied'], 400);
        }

        $consultant = Consultant::where('id', $id)->first();

        try {
            $consultant->photo = $filesHandler->uploadPhoto($consultant->user_id, $request->photo);
            $consultant->description = $request->description;
            $consultant->specialization_id = $request->specialization_id;
            $consultant->profession_id = $request->profession_id;

            $consultant->save();

            return ConsultantShowResource::collection(Consultant::where('id', $id)->with('user', 'specialization', 'profession')->get());

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in UserController.update'
            ], 400);
        }
    }

    public function destroy(string $id)
    {
        $role = new Role();
        $isAdmin = $role->isAdmin(Auth()->user()->id);

        if(!$isAdmin) {
            return response()->json(['error' => 'Access is denied'], 400);
        }

        try {
            Consultant::destroy($id);
            return response()->json([
                'message' => 'Record successfully deleted'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in UserController.destroy'
            ], 400);
        }
    }
}
