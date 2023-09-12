<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParentedQuestion;
use Illuminate\Http\Request;

class ParentedQuestionsController extends Controller
{

    public function index(): Object
    {
        return ParentedQuestion::get();
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
