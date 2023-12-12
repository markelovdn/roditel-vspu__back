<?php

namespace App\Http\Controllers\Api;

use App\Filters\ConsultationFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Resources\ConsultantsResource;
use App\Http\Resources\ConsultationResource;
use App\Http\Resources\ParentedsResource;
use App\Models\Consultant;
use App\Models\Consultation;
use App\Models\Parented;
use App\Models\Role;
use App\Jobs\SendEmailNewConsultationForAll;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Queue;

class ConsultationsController extends Controller
{

    public function index(ConsultationFilter $filter): JsonResource
    {
        $user = auth()->user();

        $query = Consultation::with('users', 'messages')
            ->when($user->role->code === Role::CONSULTANT, function ($query) use ($user) {
                $specializationIds = Consultant::with('specializations')->where('user_id', $user->id)->first()->specialization_id;
                return $query->where(function ($query) use ($user, $specializationIds) {
                    $query->where('specialization_id', $specializationIds)
                        ->where('consultant_user_id', null)
                        ->orWhere('consultant_user_id', $user->id);
                });
            })
            ->when($user->role->code === Role::PARENTED, function ($query) use ($user) {
                return $query->where('parented_user_id', $user->id);
            })
            ->orderBy('created_at', 'desc');

        $consultations = $query->filter($filter)->get();

        return ConsultationResource::collection($consultations);
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
            $consultation->parented_user_id = $parented->user->id;
            $consultation->specialization_id = $request->specializationId;

            if ($request->allConsultants) {
                $consultation->consultant_user_id = null;

                $consultants = Consultant::with('user')->where('specialization_id', $request->specializationId)->get();

                $consultation->save();

                $messageData = [
                    'consultation_id' => $consultation->id,
                    'user_id' => $parented->user->id,
                    'text' => $request->messageText,
                    'readed' => false,
                ];
                $consultation->messages()->insert($messageData);

                foreach ($consultants as $consultant) {
                    Queue::push(new SendEmailNewConsultationForAll($consultant->user->email, $request->messageText, $parented->user));
                }
            } else {
                $consultant = Consultant::with('user')->where('user_id', $request->consultantId)->first();
                $consultation->consultant_user_id = $consultant->user->id;

                $consultation->save();

                $messageData = [
                    'consultation_id' => $consultation->id,
                    'user_id' => $parented->user->id,
                    'text' => $request->messageText,
                    'readed' => false,
                ];
                $consultation->messages()->insert($messageData);

                $consultation->users()->attach([$consultant->user->id => ['owner' => false], $parented->user->id => ['owner' => true]]);

                Queue::push(new SendEmailNewConsultationForAll($consultant->user->email, $request->messageText, $parented->user));
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

    public function getAllConsultantsForParented(): JsonResource
    {
        $consultantUserId = Consultation::where('parented_user_id', auth()->user()->id)->pluck('consultant_user_id')->toArray();

        return ConsultantsResource::collection(Consultant::with('user')->whereIn('user_id', $consultantUserId)->get());
    }

    public function getAllParentedsForConsultant(): JsonResource
    {
        $parentedUserId = Consultation::where('consultant_user_id', auth()->user()->id)->pluck('parented_user_id')->toArray();

        return ParentedsResource::collection(Parented::with('user')->whereIn('user_id', $parentedUserId)->get());
    }

    public function closeConsultation(Request $request): JsonResponse
    {
        $this->validate($request, [
            'consultationId' => ['required', 'exists:consultations,id'],
        ]);

        $consultation = Consultation::where('id', $request->consultationId)
            ->whereHas('users', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->first();

        if ($consultation) {
            $consultation->closed = true;
            $consultation->save();
            return response()->json([
                'message' => 'Consultation successfully closed'
            ], 200);
        }
    }
}
