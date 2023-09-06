<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'firstName' => $this->first_name,
            'secondName' => $this->second_name,
            'surName' => $this->patronymic,
            'fullName' => "$this->first_name $this->second_name $this->patronymic",
            'email' => $this->email,
            'role' => [
                'id' => $this->role->id,
                'code' => $this->role->code,
                'title' => $this->role->title,
            ],
            'parented' => [$this->parented],
            'consultant' => [
                'id' => $this->consultant->id,
                'userId' => $this->consultant->user_id,
                'photo' => $this->consultant->id,
                'specializationId' => $this->consultant->specialization_id,
                'professionId' => $this->consultant->profession_id,
                'contract' => [
                    'id' => $this->consultant->contract->id,
                    'number' => $this->consultant->contract->number,
                    'createdAt' => $this->consultant->contract->created_at,
                    'updatedAt' => $this->consultant->contract->updated_at
                ]
                ]
        ];
    }
}
