<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebinarsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (Auth::guard('sanctum')->user()) {
            $registered = DB::table('webinar_partisipants')->where('webinar_id', $this->id)->where('user_id', Auth::guard('sanctum')->user()->id)->exists();
        };

        return [
            'id' => $this->id,
            'title' => $this->title,
            'logo' => $this->logo,
            'date' => Carbon::parse($this->date)->format('d.m.Y'),
            'timeStart' => Carbon::parse($this->time_start)->format('H.i'),
            'timeEnd' => Carbon::parse($this->time_end)->format('H.i'),
            'cost' => $this->cost,
            'videoLink' => $this->video_link,
            'registered' => $registered,
            'webinarCategory' => [
                'title' => $this->webinarCategory->title
            ],
            'questions' => WebinarQuestionsResource::collection($this->questions),
            'lectors' => LectorResource::collection($this->lectors)
        ];
    }
}
