<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebinarLectorResource extends JsonResource
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
            'lectorName' => $this->lector_name,
            'lectorDescription' => $this->lector_description,
            'lectorDepartment' => $this->lector_department,
            'lectorPhoto' => $this->lector_photo,
            ];
    }
}
