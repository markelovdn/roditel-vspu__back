<?php

namespace App\Http\Resources;

use App\Models\Parented;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class QuestionnairesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $parented_id = DB::table('parented_questionnaire')->where('questionnaire_id', $this->id)->first();
        if (!$parented_id) {
            $parentedFullName = '';
        } else {
            $parented = Parented::where('id', $parented_id->parented_id)->with('user')->first();
            $parentedFullName = $parented->user->second_name.' '.Str::limit($parented->user->first_name, 1,('.')).Str::limit($parented->user->patronymic, 1, ('.'));
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'answerBefore' => $this->answer_before,
            'fileUrl' => $this->file_url,
            'fileName' => Str::afterLast($this->file_url, '/'),
            'status' => Carbon::parse($this->status)->format('d.m.Y'),
            'parented' => $parentedFullName,
            'updatedAt' => Carbon::parse($this->updated_at)->format('d.m.Y'),
            'questions' => QuestionsResource::collection($this->whenLoaded('questions'))
        ];
    }
}
