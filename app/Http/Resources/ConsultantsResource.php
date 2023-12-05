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
        if ($request->all) {
            $data = [
                'userId' => $this->user->id,
                'fullName' => "{$this->user->second_name} {$this->user->first_name} {$this->user->patronymic}",
                "consultantId" => $this->id,
                "specialization" => [
                    "id" => $this->specialization->id,
                    "title" => $this->specialization->title,
                ],
            ];
            return $data;
        }
        $data['user'] = [
            'id' => $this->user->id,
            'firstName' => $this->user->first_name,
            'secondName' => $this->user->second_name,
            'surName' => $this->user->patronymic,
        ];
        $data['photo'] = $this->photo;
        $data['description'] = $this->description;
        $data['profession'] = [
            "id" => $this->profession->id,
            "title" => $this->profession->title,
        ];

        return $data;
    }
}
