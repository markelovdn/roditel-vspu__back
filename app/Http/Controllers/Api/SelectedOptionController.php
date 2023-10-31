<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSelectedOptionsRequest;
use App\Models\OptionOther;
use App\Models\SelectedOption;
use Illuminate\Support\Facades\Auth;

class SelectedOptionController extends Controller
{

    public static function index()
    {

    }

    public function store(StoreSelectedOptionsRequest $request, $questionId)
    {
        $user = Auth::user()->id;

        try {
            foreach ($request->request as $item) {

                if (isset($item['option_id']))
                {
                    $selectedOption = new SelectedOption();
                    $selectedOption->question_id = $questionId;
                    $selectedOption->option_id = $item['option_id'];
                    $selectedOption->user_id = $user;
                    $selectedOption->save();

                } else {
                    $OptionOther = new OptionOther();
                    $OptionOther->text = $item['text'];
                    $OptionOther->question_id = $questionId;
                    $OptionOther->user_id = $user;
                    $OptionOther->save();
                }

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

    public function update(StoreSelectedOptionsRequest $request, $questionId)
    {
        $user = Auth::user()->id;
        $selectedOption = SelectedOption::where('question_id', $questionId)->where('user_id', $user)->delete();

        try {
            foreach ($request->request as $item) {

                if (isset($item['option_id']))
                {
                    $selectedOption = new SelectedOption();
                    $selectedOption->question_id = $questionId;
                    $selectedOption->option_id = $item['option_id'];
                    $selectedOption->user_id = $user;
                    $selectedOption->save();

                } else {
                    $OptionOther = OptionOther::where('question_id', $questionId)->where('user_id', $user)->first();
                    $OptionOther->text = $item['text'];
                    $OptionOther->question_id = $questionId;
                    $OptionOther->user_id = $user;
                    $OptionOther->save();
                }

            }
            return response()->json([
                'message' => 'Options update success'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in SelecteOptionController.store'
            ], 400);
        }
    }
}
