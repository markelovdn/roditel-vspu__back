<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VebinarsResource;
use App\Models\Vebinar;
use Illuminate\Http\Request;

class VebinarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $a = Vebinar::with('vebinarCategory')->get();
        return VebinarsResource::collection(Vebinar::with('vebinarCategory')->get());
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
