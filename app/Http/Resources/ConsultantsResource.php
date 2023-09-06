<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'photo' => $this->photo,
            'description' => $this->description,
            'user' => [
                'firstName' => $this->user->first_name,
                'secondName' => $this->user->second_name,
                'surName' => $this->user->patronymic,
            ],


        ];
    }
}
