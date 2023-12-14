<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesHandler;
use App\Filters\ConsultantFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultantRequest;
use App\Http\Requests\UpdateConsultantRequest;
use App\Http\Requests\UpdateContractNumberRequest;
use App\Http\Resources\ConsultantShowResource;
use App\Http\Resources\ConsultantsResource;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultantsController extends Controller
{
    public function index(Request $request, ConsultantFilter $filter)
    {
        if ($request->all) {
            return ConsultantsResource::collection(Consultant::with('user', 'specialization', 'profession')->get());
        } else {
            return ConsultantsResource::collection(Consultant::with('user', 'specialization', 'profession')->filter($filter)->paginate(9));
        }
    }

    public function store(StoreConsultantRequest $request, FilesHandler $filesHandler)
    {
        $consultant = Consultant::where('user_id', $request->userId)->first();

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
        return ConsultantShowResource::collection(Consultant::where('user_id', Auth::user()->id)->with('user', 'specialization', 'profession')->get());
    }

    public function update(UpdateConsultantRequest $request, string $id, FilesHandler $filesHandler)
    {
        $consultant = Consultant::where('id', $id)->first();

        try {
            $consultant->photo = $filesHandler->uploadPhoto($consultant->user_id, $request->photo);
            $consultant->description = $request->description;
            $consultant->specialization_id = $request->specializationId;
            $consultant->profession_id = $request->professionId;

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

    public function uploadPhoto(Request $request, FilesHandler $filesHandler)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $consultant = Consultant::where('user_id', $user->id)->first();

        try {
            $consultant->photo = $filesHandler->uploadPhoto($consultant->user_id, $request->photo);
            $consultant->save();

            return response()->json([
                'message' => 'Consultant photo successfully updated'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ConsultantController.uploadPhoto'
            ], 400);
        }
    }

    public function getConsultantsForAdmin()
    {
        return ConsultantsResource::collection(Consultant::with('user', 'specialization', 'profession', 'contract')->paginate(10));
    }

    public function updateContractNumber(UpdateContractNumberRequest $request, string $consultantId)
    {
        try {
            $contract = Contract::where('consultant_id', $consultantId)->first();

            if (!$contract) {
                $contract = new Contract();
                $contract->consultant_id = $consultantId;
                $contract->number = $request->contractNumber;
                $contract->save();
            }
            $contract->number = $request->contractNumber;
            $contract->save();

            return response()->json([
                'message' => 'Contract number successfully updated'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in ConsultantController.updateContractNumber'
            ], 400);
        }
    }
}
