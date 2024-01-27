<?php

namespace App\Http\Resources;

use App\Models\Consultant;
use App\Models\ConsultationMessage;
use App\Models\Parented;
use App\Models\Specialization;
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
        if (count($consultationMessages) === 0) {
            $region = "";
        } else {
            $region = Parented::with('region')->where('user_id', $consultationMessages->first()->user_id)->first();
        }


        return [

            "id" => $this->id,
            "title" => $this->title . ' ' . $this->id,
            "closed" => $this->closed === 0 ? false : true,
            "createdAt" => Carbon::parse($this->created_at)->getTimestampMs(),
            "createdAt" => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            "updatedAt" => Carbon::parse($this->updated_at)->getTimestampMs(),
            "specialization" => new SpecializationsResource(Specialization::find($this->specialization_id)),
            "region" => $region->region->title ?? null,
            "users" => UserResource::collection($this->whenLoaded('users')),
            "messages" => ConsultationMessagesResource::collection($this->whenLoaded('messages')),
            "isActive" => count($consultationMessages) > 1 ? true : false
        ];
    }
}
