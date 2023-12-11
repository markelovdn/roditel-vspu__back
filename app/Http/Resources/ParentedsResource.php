<?php

namespace App\Http\Resources;

use App\Models\Role;
use App\Models\User;
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
        if ($request->all) {
            $data = [
                'userId' => $this->user->id,
                'parentedId' => $this->id,
                'regionId' => $this->region_id,
                'fullName' => "{$this->user->second_name} {$this->user->first_name} {$this->user->patronymic}",
            ];
            return $data;
        }

        if (auth()->user() && User::where('id', auth()->user()->id)->first()->role->code == Role::ADMIN) {
            $data = [
                'userId' => $this->user->id,
                'parentedId' => $this->id,
                'fullName' => "{$this->user->second_name} {$this->user->first_name} {$this->user->patronymic}",
                'email' => $this->user->email,
            ];
            return $data;
        }

        return [
            'id' => $this->id,
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
