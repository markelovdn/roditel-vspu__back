<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class OptionsController extends Controller
{

    public static function store(array $options, int $questionId)
    {
        //TODO:сделать валидацию массива
        $question = Question::find($questionId);

        foreach ($options as $item) {
            $option = new Option();

            $option->text = $item['text'];

            if ($item['text'] != null) {
                $option->save();
                $question->options()->attach($option->id);
            }
        }
    }

    public static function update(array $options, int $questionId)
    {
        //TODO:сделать валидацию массива
        $question = Question::with('options')->find($questionId);

        foreach ($options as $item) {
            if (!isset($item['id'])) {
                $option = new Option();

                $option->text = $item['text'];
                $option->save();

                $question->options()->attach($option->id);
            } else {
                $option = Option::find($item['id']);;

                $option->text = $item['text'];
                $option->save();

                $question->options()->sync($option->id);
            }
        }
    }

    public static function destroy(string $id)
    {
        //
    }
}
