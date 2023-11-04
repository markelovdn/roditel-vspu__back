<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionsResource extends JsonResource
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
            'text' => $this->text,
            'description' => $this->description,
            'type' => $this->answer_type,
            'options' => OptionsResource::collection($this->whenLoaded('options')),
            'other' => new OptionOthersResource($this->whenLoaded('optionOther'))
        ];
    }
}
