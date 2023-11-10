<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultantRequest;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;
use App\Models\Parented;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationsController extends Controller
{

    public function index(): JsonResource
    {
        return ConsultationResource::collection(Consultation::with('users', 'messages')->where('user_id', auth()->user()->id)->get());
    }

    public function store(StoreConsultationRequest $request)
    {
        $user = Parented::where('user_id', auth()->user()->id)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Only a parent can request a consultation'
            ], 404);
        }

        $consultation = new Consultation();

        try {
            $consultation->title = $request->title;
            $consultation->closed = false;
            $consultation->user_id = $user->id;

            $consultation->save();

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

    public function show(int $id)
    {
        $a = auth()->user()->id;
        $a = Consultation::with('users', 'messages')
        ->where('user_id', auth()->user()->id)
        ->where('id', $id)->first();
        return ConsultationResource::collection(Consultation::with('users', 'messages')
        ->where('user_id', auth()->user()->id)
        ->where('id', $id)->get());
    }

    public function update(UpdateConsultationRequest $request, string $id)
    {
        $user = Parented::where('user_id', auth()->user()->id)->first();
        if (!$user) {
            return response()->json([
                'message' => 'Only a parent can update a consultation'
            ], 404);
        }

        try {
            $consultation = Consultation::find($id);

            $consultation->title = $request->title;
            $consultation->closed = $request->closed;

            $consultation->save();

            return response()->json([
                'message' => 'Consultation successfully udated'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in ConsultantationsController.update'
            ], 400);
        }
    }

    public function destroy(string $id)
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
