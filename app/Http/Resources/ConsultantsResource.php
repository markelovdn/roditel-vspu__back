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
        $data = [
            'userId' => $this->user->id,
            'consultantId' => $this->id,
            'fullName' => "{$this->user->second_name} {$this->user->first_name} {$this->user->patronymic}",
            'photo' => $this->photo,
            'specializations' => $this->specializations->map(function ($specialization) {
                return [
                    'id' => $specialization->id,
                    'title' => $specialization->title,
                ];
            })->toArray(),
        ];

        if (auth()->user() && User::where('id', auth()->user()->id)->first()->role->code == Role::ADMIN) {
            $data['phone'] = $this->user->phone;
            $data['contractNumber'] = $this->contract->number ?? null;
        }

        if ($request->all) {
            $data = [
                'userId' => $this->user->id,
                'consultantId' => $this->id,
                'fullName' => "{$this->user->second_name} {$this->user->first_name} {$this->user->patronymic}",
                'photo' => $this->photo,
                'specializations' => $this->specializations->map(function ($specialization) {
                    return [
                        'id' => $specialization->id,
                        'title' => $specialization->title,
                    ];
                })->toArray(),
            ];
        } else {
            $data = [
                'user' => [
                    'id' => $this->user->id,
                    'firstName' => $this->user->first_name,
                    'secondName' => $this->user->second_name,
                    'surName' => $this->user->patronymic,
                ],
                'description' => $this->description,
                'profession' => [
                    'id' => $this->profession->id,
                    'title' => $this->profession->title,
                ],
                'photo' => $this->photo,
            ];
        }

        return $data;
    }
}
