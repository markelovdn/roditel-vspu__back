<?php

namespace App\Http\Resources;

use App\Models\Role;
use App\Models\User;
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

        if (auth()->user() && User::where('id', auth()->user()->id)->first()->role->code == Role::ADMIN) {
            $data = [
                'userId' => $this->user->id,
                'consultantId' => $this->id,
                'photo' => $this->photo,
                'fullName' => "{$this->user->second_name} {$this->user->first_name} {$this->user->patronymic}",
                'phone' => $this->user->phone,
                'specializationTitle' => $this->specialization->title,
                'contractNumber' => $this->contract->number ?? null
            ];
            return $data;
        }

        if ($request->all) {
            $data = [
                'userId' => $this->user->id,
                'fullName' => "{$this->user->second_name} {$this->user->first_name} {$this->user->patronymic}",
                "consultantId" => $this->id,
                "specialization" => [
                    "id" => $this->specialization->id,
                    "title" => $this->specialization->title,
                ]
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
