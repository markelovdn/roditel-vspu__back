<?php

namespace App\Http\Resources;

use App\Models\Consultant;
use App\Models\ConsultationMessage;
use App\Models\Parented;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $consultationMessages = ConsultationMessage::where('consultation_id', $this->id)->get();

        return [
            "id" => $this->id,
            "title" => $this->title,
            "closed" => $this->closed === 0 ? false : true,
            "createdAt" => Carbon::parse($this->created_at)->timestamp,
            "updatedAt" => Carbon::parse($this->updated_at)->timestamp,
            "specializationId" => SpecializationsResource::collection($this->whenLoaded('specializations')),
            "users" => UserResource::collection($this->whenLoaded('users')),
            "messages" => ConsultationMessagesResource::collection($this->whenLoaded('messages')),
            "isActive" => count($consultationMessages) > 1 ? true : false
        ];
    }
}
