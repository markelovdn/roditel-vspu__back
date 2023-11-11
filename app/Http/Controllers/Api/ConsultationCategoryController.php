<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultationCategoriesResource;
use App\Models\ConsultationCategory;
use Illuminate\Http\Request;

class ConsultationCategoryController extends Controller
{

    public function index()
    {
        return ConsultationCategoriesResource::collection(ConsultationCategory::get());
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsultationCategory $consultationCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConsultationCategory $consultationCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConsultationCategory $consultationCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsultationCategory $consultationCategory)
    {
        //
    }
}
