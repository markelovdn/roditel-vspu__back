<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionsRequest;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    public static function store(array $questions, int $questionnairyId): void
    {
        $questionnairy = Questionnaire::find($questionnairyId);

        foreach ($questions as $item) {
            $question = new Question();

            $question->text = $item['text'];
            $question->description = $item['description'];
            $question->answer_type = $item['type'];
            $question->save();

            $questionnairy->questions()->attach($question->id);

            if ($item['type'] === "text") {
                $item['options'] = [];
            }

            OptionsController::store($item['options'], $item['other'], $question->id);
        }
    }

    public static function update(array $questions, int $questionnairyId): void
    {
        $questionnairy = Questionnaire::with('questions')->find($questionnairyId);
        $questionnairy->questions()->detach();

        foreach ($questions as $item) {
            if (!isset($item['id'])) {
                $question = new Question();

                $question->text = $item['text'];
                $question->description = $item['description'];
                $question->answer_type = $item['type'];
                $question->save();

                $questionnairy->questions()->attach($question->id);

                OptionsController::store($item['options'], $item['other'], $question->id);
            } else {
                $question = Question::find($item['id']);

                $question->text = $item['text'];
                $question->description = $item['description'];
                $question->answer_type = $item['type'];
                $question->save();

                $questionnairy->questions()->attach($question->id);

                OptionsController::update($item['options'], $question->id);
            }
        }
    }

    public static function destroy(string $id): void
    {
        //
    }
}
