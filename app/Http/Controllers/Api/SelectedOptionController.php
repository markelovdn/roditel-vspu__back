<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSelectedOptionsRequest;
use App\Models\OptionOther;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\SelectedOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SelectedOptionController extends Controller
{

    public static function index($id)
    {
        $userId = Auth::user()->id;
        $questionIds = DB::table('question_questionnaire')
            ->where('questionnaire_id', $id)
            ->pluck('question_id')
            ->toArray();
        $selectedOption = DB::table('selected_options')
            ->whereIn('question_id', $questionIds)
            ->pluck('option_id')
            ->toArray();
        $questionnaire = Questionnaire::with([
            'questions' => function ($query) use ($selectedOption) {
                $query->with(['options' => function ($query) use ($selectedOption) {
                    $query->whereIn('option_id', $selectedOption);
                }]);
            }
        ])->find($id);

        return $questionnaire;
    }

    public function store(StoreSelectedOptionsRequest $request, $questionId)
    {
        $user = Auth::user()->id;

        try {
            foreach ($request->selected as $item) {
                $selectedOption = new SelectedOption();
                $selectedOption->question_id = $item['questionId'];
                $selectedOption->option_id = $item['optionId'];
                $selectedOption->user_id = $user;
                $selectedOption->save();
            }

            foreach ($request->other as $item) {
                $OptionOther = OptionOther::where('question_id', $item['questionId'])->first();
                if (!$OptionOther) {
                    $OptionOther = new OptionOther();
                    $OptionOther->text = $item['text'];
                    $OptionOther->question_id = $item['questionId'];
                    $OptionOther->user_id = $user;
                    $OptionOther->save();
                }
                $OptionOther->text = $item['text'];
                $OptionOther->user_id = $user;
                $OptionOther->save();
            }


            return response()->json([
                'message' => 'Options add success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in SelecteOptionController.store'
            ], 400);
        }
    }

    // public function update(StoreSelectedOptionsRequest $request, $questionId)
    // {
    //     $user = Auth::user()->id;
    //     $selectedOption = SelectedOption::where('question_id', $questionId)->where('user_id', $user)->delete();

    //     try {
    //         foreach ($request->request as $item) {

    //             if (isset($item['option_id']))
    //             {
    //                 $selectedOption = new SelectedOption();
    //                 $selectedOption->question_id = $questionId;
    //                 $selectedOption->option_id = $item['option_id'];
    //                 $selectedOption->user_id = $user;
    //                 $selectedOption->save();

    //             } else {
    //                 $OptionOther = OptionOther::where('question_id', $questionId)->where('user_id', $user)->first();
    //                 $OptionOther->text = $item['text'];
    //                 $OptionOther->question_id = $questionId;
    //                 $OptionOther->user_id = $user;
    //                 $OptionOther->save();
    //             }

    //         }
    //         return response()->json([
    //             'message' => 'Options update success'
    //         ], 200);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Something went wrong in SelecteOptionController.store'
    //         ], 400);
    //     }
    // }
}
