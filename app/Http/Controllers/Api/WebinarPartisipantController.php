<?php

namespace App\Http\Controllers\Api;

use App\BusinessProcess\WebinarParticipants;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWebinarPartisipantRequest;
use App\Http\Requests\UpdateWebinarPartisipantRequest;
use App\Models\WebinarPartisipant;

class WebinarPartisipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(WebinarPartisipant $webinarPartisipant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebinarPartisipant $webinarPartisipant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWebinarPartisipantRequest $request, WebinarPartisipant $webinarPartisipant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebinarPartisipant $webinarPartisipant)
    {
        //
    }
}
