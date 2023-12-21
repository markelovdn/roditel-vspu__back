<?php

namespace App\Http\Controllers\Api;

use App\DomainService\FilesExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSelectedOptionsRequest;
use App\Jobs\SendEmailAnsweredToQuestionnaire;
use App\Models\Consultant;
use App\Models\OptionOther;
use App\Models\Parented;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\SelectedOption;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;

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

    public function store(StoreSelectedOptionsRequest $request, $questionnaireId)
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

            $questionnaire = Questionnaire::find($questionnaireId);

            $fileUrl = config('filesystems.disks.public.url') . '/consultants/questionnaires/' . Str::replace(' ', '_', $questionnaire->title) . '_' . Carbon::now()->format('d.m.Y') . '.xlsx';

            $questionnaire->file_url = $fileUrl;
            $questionnaire->status = Carbon::now();
            $questionnaire->save();

            FilesExport::surveyExport($fileUrl, $questionnaire->id);

            $parented = Parented::with('user')->where('user_id', $user)->first();
            DB::table('parented_questionnaire')
                ->where('parented_id', $parented->id)
                ->update(['answered' => true]);

            $consultant = Consultant::with('user')->where('id', $questionnaire->consultant_id)->first();

            Queue::push(new SendEmailAnsweredToQuestionnaire($consultant->user->email, $parented->user));

            return response()->json([
                'message' => 'Options add success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Something went wrong in SelecteOptionController.store'
            ], 400);
        }
    }
}
