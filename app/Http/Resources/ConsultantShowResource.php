<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantShowResource extends JsonResource
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
            'userId' => $this->user_id,
            'photo' => $this->photo,
            'description' => $this->description,
            'specializations' => $this->specializations->map(function ($specialization) {
                return [
                    'id' => $specialization->id,
                    'title' => $specialization->title,
                ];
            })->toArray(),
            'profession' => [
                'id' => $this->profession->id,
                'title' => $this->profession->title,
            ],
        ];
    }
}
