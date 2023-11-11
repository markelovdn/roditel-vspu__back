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

        $consultation = new Consultation();
        $consultant = Consultant::with('user')->where('id', $request->consultantId)->first();

        try {
            $consultation->title = $request->title;
            $consultation->closed = false;
            $consultation->user_id = $parented->user->id;
            $consultation->category_id = $request->categoryId;

            $consultation->save();

            $consultation->users()->attach($consultant->user->id);
            $consultation->users()->attach($parented->user->id);

            if ($request->allConsultants) {
                $consultants = Consultant::all();
                foreach ($consultants as $consultant) {
                    $consultation->users()->attach($consultant->user->id);

                    $consultation->messages()->insert([
                        'consultation_id' => $consultation->id,
                        'user_id' => $parented->user->id,
                        'text' => $request->messageText,
                        'readed' => false
                    ]);
                }
            }

            $consultation->messages()->insert([
                'consultation_id' => $consultation->id,
                'user_id' => $parented->user->id,
                'text' => $request->messageText,
                'readed' => false
            ]);

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

    public function show(int $id): JsonResource
    {
        return ConsultationResource::collection(Consultation::with('users', 'messages')
        ->where('user_id', Auth::user()->id)
        ->where('id', $id)->get());
    }

    public function update(UpdateConsultationRequest $request, string $id): JsonResponse
    {
        $parented = Parented::with('user')->where('user_id', auth()->user()->id)->first();
        if (!$parented) {
            return response()->json([
                'message' => 'Only a parent can request a consultation'
            ], 404);
        }

        $consultation = Consultation::find($id);
        $oldConsultant = Consultant::with('user')->where('id', '!=', $consultation->user_id)->first();
        $newConsultant = Consultant::with('user')->where('id', $request->consultantId)->first();

        try {
            $consultation->title = $request->title;
            $consultation->closed = $request->closed;
            $consultation->user_id = $parented->user->id;
            $consultation->category_id = $request->categoryId;

            $consultation->save();

            $consultation->users()->detach($oldConsultant->user->id);
            $consultation->users()->attach($newConsultant->user->id);
            $consultation->users()->attach($parented->user->id);

            if ($request->allConsultants) {
                $consultants = Consultant::all();
                foreach ($consultants as $consultant) {
                    $consultation->users()->attach($consultant->user->id);

                    $consultation->messages()->insert([
                        'consultation_id' => $consultation->id,
                        'user_id' => $parented->user->id,
                        'text' => $request->messageText,
                        'readed' => false
                    ]);
                }
            }

            return response()->json([
                'message' => 'Consultation successfully udated'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in ConsultantationsController.update'
            ], 400);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
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
