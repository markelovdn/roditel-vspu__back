<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'date' => Carbon::parse($this->date)->format('d.m.Y'),
            'timeStart' => Carbon::parse($this->time_start)->format('H.i'),
            'timeEnd' => Carbon::parse($this->time_end)->format('H.i'),
            'cost' => $this->cost,
            'webinarCategory' => [
                'title' => $this->webinarCategory->title
            ],
            'questions' => WebinarQuestionsResource::collection($this->questions),
            'lectors' => LectorResource::collection($this->lectors)
        ];
    }
}
