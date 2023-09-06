<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultantsResource;
use App\Models\Consultant;
use Illuminate\Http\Request;

class ConsultantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ConsultantsResource::collection(Consultant::with('user', 'specialization', 'profession')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
