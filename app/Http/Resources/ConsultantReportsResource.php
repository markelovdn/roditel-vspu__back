<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ConsultantReportsResource extends JsonResource
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
            'fileUrl' => $this->file_url,
            'fileName' => Str::afterLast($this->file_url, '/'),
            'uploadStatus' => $this->upload_status,
            'createdAt' => Carbon::parse($this->created_at)->format('d.m.Y'),
            'updatedAt' => Carbon::parse($this->updated_at)->format('d.m.Y'),
        ];
    }
}
