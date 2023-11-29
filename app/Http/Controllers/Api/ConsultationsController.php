<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultantRequest;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Http\Resources\ConsultationResource;
use App\Models\Consultant;
use App\Models\Consultation;
use App\Models\Parented;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultationsController extends Controller
{

    public function index(): JsonResource
    {
        return ConsultationResource::collection(Consultation::with('users', 'messages')->where('user_id', auth()->user()->id)->get());
    }

    public function store(StoreConsultationRequest $request): JsonResponse
    {
        $parented = Parented::with('user')->where('user_id', auth()->user()->id)->first();
        if (!$parented) {
            return response()->json([
                'message' => 'Only a parent can request a consultation'
            ], 404);
        }

        try {

            $consultation = new Consultation();
            $consultation->title = "Завяка ";
            $consultation->closed = false;
            $consultation->user_id = $parented->user->id;
            $consultation->specialization_id = $request->specializationId;

            $consultation->save();

            $consultation->title .= $consultation->id;

            $consultation->save();

            $messageData = [
                'consultation_id' => $consultation->id,
                'user_id' => $parented->user->id,
                'text' => $request->messageText,
                'readed' => false,
            ];
            $consultation->messages()->insert($messageData);

            if ($request->allConsultants) {
                $consultants = Consultant::with('user')->where('specialization_id', $request->specializationId)->get();
                foreach ($consultants as $consultant) {
                    $consultation->users()->attach([$consultant->user->id => ['owner' => false], $parented->user->id => ['owner' => true]]);
                }
            } else {
                $consultant = Consultant::with('user')->where('user_id', $request->consultantId)->first();
                $consultation->users()->attach([$consultant->user->id => ['owner' => false], $parented->user->id => ['owner' => true]]);
            }

            return response()->json([
                'message' => 'Consultation successfully added'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ConsultantationsController.store'
            ], 400);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        $consultation = Consultation::where('id', $id)->first();

        try {
            if ($consultation && $consultation->messages()->count() > 1) {
                return response()->json([
                    'message' => 'You can\'t delete a consultation with messages'
                ], 400);
            }
            Consultation::destroy($id);
            return response()->json([
                'message' => 'Consultation successfully deleted'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ConsultationController.destroy'
            ], 400);
        }
    }
}
