<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebinarProgramResource extends JsonResource
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
            'timeStart' => Carbon::parse($this->time_start)->format('H.i'),
            'subject' => $this->subject,
            'lectorDescription' => $this->lector_description,
            'lectorDepartment' => $this->lector_department,
            'lectorPhoto' => $this->lector_photo,
            'timeStart' => $this->time_start,
        ];
    }
}
