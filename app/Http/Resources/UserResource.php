<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use SebastianBergmann\Type\ObjectType;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): Array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'secondName' => $this->second_name,
            'surName' => $this->patronymic,
            'fullName' => "$this->first_name $this->second_name $this->patronymic",
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => [
                'id' => $this->role->id,
                'code' => $this->role->code,
                'title' => $this->role->title,
                ]
            ];
    }
}
