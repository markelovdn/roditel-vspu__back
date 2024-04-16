<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationRatingRequest;
use App\Models\ConsultationRating;
use App\Models\RatingQuestion;
use Illuminate\Http\Request;

class ConsultationRatingController extends Controller
{
    public function store(StoreConsultationRatingRequest $request)
    {
        $data = $request->validated();
        $ratings = [];

        foreach ($data['ratings'] as $rating) {
            $ratings[] = [
                'consultation_id' => $data['consultation_id'],
                'rating_question_id' => $rating['rating_question_id'],
                'rating_answer' => $rating['rating_answer'],
            ];
        }

        ConsultationRating::insert($ratings);

        return response()->json([
            'message' => "Rating successfully created!",
        ]);
    }

    public function getRatingCollection()
    {
        return RatingQuestion::all();
    }
}
