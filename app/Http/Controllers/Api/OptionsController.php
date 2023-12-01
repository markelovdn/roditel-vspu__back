<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OptionOther;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OptionsController extends Controller
{

    public static function store(array $options, array $other, int $questionId)
    {
        $question = Question::find($questionId);

        if ($other['show'] === true) {
            $otherOption = new OptionOther();
            $otherOption->text = "";
            $otherOption->show = true;
            $otherOption->question_id = $question->id;
            $otherOption->user_id = Auth::user()->id;
            $otherOption->save();
        }

        foreach ($options as $item) {
            $option = new Option();

            $option->text = $item['text'];
            $option->save();
            $question->options()->attach($option->id);

            // if ($item['text'] != null) {

            // }
        }
    }

    public static function update(array $options, int $questionId)
    {
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
