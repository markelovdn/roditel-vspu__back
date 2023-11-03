<?php

namespace App\Http\Resources;

use App\Models\Question;
use App\Models\QuestionnaireAnswer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionnairesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'answerBefore' => $this->answer_before,
            'updatedAt' => $this->updated_at,
            'questions' => QuestionsResource::collection($this->whenLoaded('questions'))
        ];
    }
}
