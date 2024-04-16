<?php

namespace App\Http\Resources;

use App\Models\Consultant;
use App\Models\Parented;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Type\ObjectType;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $parented = Parented::where('user_id', Auth::user()->id)->first();
        $consultant = Consultant::where('user_id', Auth::user()->id)->first();

        if ($parented) {
            return [
                'id' => $this->id,
                'firstName' => $this->first_name,
                'secondName' => $this->second_name,
                'surName' => $this->patronymic,
                'fullName' => "$this->second_name $this->first_name $this->patronymic",
                'email' => $this->email,
                'phone' => $this->phone,
                'ragionId' => $parented->region_id,
                'role' => [
                    'id' => $this->role->id,
                    'code' => $this->role->code,
                    'title' => $this->role->title,
                ]
            ];
        } else if ($consultant) {
            $specializations = $consultant->specializations ? $consultant->specializations->map(function ($specialization) {
                return [
                    'id' => $specialization->id,
                    'title' => $specialization->title,
                ];
            })->toArray() : [];
            return [
                'id' => $this->id,
                'firstName' => $this->first_name,
                'secondName' => $this->second_name,
                'surName' => $this->patronymic,
                'fullName' => "$this->second_name $this->first_name $this->patronymic",
                'email' => $this->email,
                'phone' => $this->phone,
                'specializations' => $specializations,
                'professionId' => $consultant->profession_id,
                'description' => $consultant->description,
                'photo' => $consultant->photo,
                'role' => [
                    'id' => $this->role->id,
                    'code' => $this->role->code,
                    'title' => $this->role->title,
                ]
            ];
        } else {
            return [
                'id' => $this->id,
                'firstName' => $this->first_name,
                'secondName' => $this->second_name,
                'surName' => $this->patronymic,
                'fullName' => "$this->second_name $this->first_name $this->patronymic",
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
}
