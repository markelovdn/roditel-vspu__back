<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionsRequest;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class QuestionsController extends Controller
{
    public static function store(array $questions, int $questionnairyId): void
    {
        //TODO:сделать валидацию массива
        $questionnairy = Questionnaire::find($questionnairyId);

        foreach ($questions as $item) {
            $question = new Question();

            $question->text = $item['text'];
            $question->answer_type = $item['type'];
            $question->save();

            $questionnairy->questions()->attach($question->id);

            OptionsController::store($item['options'], $question->id);
        }
    }

    public static function update(array $questions, int $questionnairyId): void
    {
        //TODO:сделать валидацию массива
        $questionnairy = Questionnaire::find($questionnairyId);

        foreach ($questions as $item) {
            $question = Question::where('id', $item['id'])->first();

            $question->text = $item['text'];
            $question->answer_type = $item['type'];
            $question->save();

            $questionnairy->questions()->sync($question->id);

            OptionsController::update($item['options'], $question->id);
        }
    }

    public static function destroy(string $id): void
    {
        //
    }
}
