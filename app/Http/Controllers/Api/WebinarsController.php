<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebinarQuestionsResource;
use App\Http\Resources\WebinarsResource;
use App\Models\Webinar;
use Illuminate\Http\Request;

class WebinarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Webinar::with('webinarCategory', 'questions')->get();
        return WebinarsResource::collection(Webinar::with('webinarCategory')->paginate(19));
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
        return WebinarsResource::collection(Webinar::where('id', $id)->with('webinarCategory', 'questions')->get());;
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
