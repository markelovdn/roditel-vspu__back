<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentedsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'regionId' => $this->region_id,
            'user' => [
                'userId' => $this->user->id,
                'firstName' => $this->user->first_name,
                'patronymic' => $this->user->patronymic,
                'secondName' => $this->user->second_name,
            ]

        ];
    }
}
