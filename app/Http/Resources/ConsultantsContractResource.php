<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultantsContractResource extends JsonResource
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
            'consultantId' => $this->consultant_id,
            'number' => $this->consultant_id,
            'updatedAt' => Carbon::parse($this->updated_at)->format('d.m.Y'),
        ];
    }
}
