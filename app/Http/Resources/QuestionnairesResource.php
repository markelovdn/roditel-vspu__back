<?php

namespace App\Http\Resources;

use App\Models\Consultant;
use App\Models\Parented;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
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
            $consultanFullName = '';
        } else {
            $parented = Parented::where('id', $parented_id->parented_id)->with('user')->first();
            $consultant = Consultant::where('id', $this->consultant_id)->with('user')->first();
            $parentedFullName = $parented->user->second_name.' '.Str::limit($parented->user->first_name, 1,('.')).Str::limit($parented->user->patronymic, 1, ('.'));
            $consultanFullName = $consultant->user->second_name.' '.Str::limit($consultant->user->first_name, 1,('.')).Str::limit($consultant->user->patronymic, 1, ('.'));
        }
        $status = null;
        if ($this->status !== null) {
            $status = Carbon::parse($this->status)->format('d.m.Y');
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'answerBefore' => Carbon::parse($this->answer_before)->format('d.m.Y'),
            'fileUrl' => $this->file_url,
            'fileName' => Str::afterLast($this->file_url, '/'),
            'status' => $status,
            'parented' => $parentedFullName,
            'consultant' => $consultanFullName,
            'updatedAt' => Carbon::parse($this->updated_at)->format('d.m.Y'),
            'questions' => QuestionsResource::collection($this->whenLoaded('questions'))
        ];
    }
}
