<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebinarsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'title' => $this->title,
            'date' => $this->date,
            'timeStart' => $this->time_start,
            'timeEnd' => $this->time_end,
            'lectorName' => $this->lector_name,
            'logo' => $this->logo,
            'cost' => $this->cost,
            'webinarCategory' => [
                'tite' => $this->webinarCategory->title
            ],
            'questions' => WebinarQuestionsResource::collection($this->questions)
        ];
    }
}
