<?php

namespace App\Exports;

use App\Models\Questionnaire;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class SurveyExport implements FromView
{
    use Exportable;
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $id = $this->id;

        $questionIds = DB::table('question_questionnaire')
            ->where('questionnaire_id', $id)
            ->pluck('question_id')
            ->toArray();
        $selectedOption = DB::table('selected_options')
            ->whereIn('question_id', $questionIds)
            ->pluck('option_id')
            ->toArray();

        $questionnaire = Questionnaire::query()->where('id', $id)->with([
            'questions' => function ($query) use ($selectedOption) {
                $query->with(['options' => function ($query) use ($selectedOption) {
                    $query->whereIn('option_id', $selectedOption);
                }]);
            }
        ])->first();

        return view('exports.survey', [
            'questionnaire' => $questionnaire
        ]);
    }
}
