<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVebinarPartisipantRequest;
use App\Http\Requests\UpdateVebinarPartisipantRequest;
use App\Models\VebinarPartisipant;

class VebinarPartisipantController extends Controller
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
    public function store(StoreVebinarPartisipantRequest $request)
    {
        $vebinarPartisipant = new VebinarPartisipant();

        try {
            $vebinarPartisipant->vebinar_id = $request->vebinar_id;
            $vebinarPartisipant->user_id = $request->user_id;

            $vebinarPartisipant->save();

            return response()->json([
                'message' => 'User successfully added for vebinar'
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
    public function show(VebinarPartisipant $vebinarPartisipant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VebinarPartisipant $vebinarPartisipant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVebinarPartisipantRequest $request, VebinarPartisipant $vebinarPartisipant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VebinarPartisipant $vebinarPartisipant)
    {
        //
    }
}
