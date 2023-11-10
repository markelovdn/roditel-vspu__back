<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationMessagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "userId" => $this->user_id,
            "text" => $this->text,
            "readed" => $this->readed === 0 ? false : true,
            "createdAt" => Carbon::parse($this->created_at)->format('d.m.Y'),
            "updatedAt" => Carbon::parse($this->updated_at)->format('d.m.Y'),
        ];
    }
}
