<?php

namespace App\Http\Controllers\Api;

use App\BusinessProcess\WebinarParticipants;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebinarPartisipantRequest;
use App\Http\Requests\UpdateWebinarPartisipantRequest;
use App\Models\WebinarPartisipant;
use App\Http\Resources\WebinarPartisipantsResource;
use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class WebinarPartisipantController extends Controller
{
    /**
     * @param RegistrationRequest $request
     * @return JsonResource
     */

    public function index(): JsonResource
    {
        $role = new Role();
        $isAdmin = $role->isAdmin(Auth()->user()->id);

        $result = $isAdmin ?
                    WebinarPartisipantsResource::collection(WebinarPartisipant::get()) :
                    response()->json(['error' => 'Access is denied'], 400);

        return $result;
    }

    public function store(StoreWebinarPartisipantRequest $request, WebinarParticipants $checkPartisipant)
    {
        $webinarPartisipant = new WebinarPartisipant();

        if(!$checkPartisipant->isUnique($request->webinar_id, $request->user_id)) {
            return response()->json([
                'warning' => 'The participant is already registered'
            ], 300);
        }

        try {
            $webinarPartisipant->webinar_id = $request->webinar_id;
            $webinarPartisipant->user_id = $request->user_id;

            $webinarPartisipant->save();

            return response()->json([
                'message' => 'User successfully added for webinar'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in UserController.store'
            ], 400);
        }
    }

    public function show(WebinarPartisipant $webinarPartisipant)
    {
        //
    }


    public function update(UpdateWebinarPartisipantRequest $request, WebinarPartisipant $webinarPartisipant)
    {
        //
    }

    public function destroy(WebinarPartisipant $webinarPartisipant)
    {
        //
    }
}
