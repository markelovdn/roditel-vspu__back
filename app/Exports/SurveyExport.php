<?php

namespace App\Exports;

use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SurveyExport implements FromQuery, WithMapping
{
    use Exportable;
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function query()
    {
        $id = $this->id;
        // Здесь вы можете определить запрос для получения данных анкеты с вопросами и ответами
        return Question::query()->whereHas('questionnaire', function ($query) use ($id) {
            $query->where('questionnaire_id', '=', $id);
        })->with('options')->orderBy('updated_at', 'desc');
    }
    /**
     * @param Question $question
     */
    public function map($question): array
    {
        $num = 0;

        return [
            $num + 1,
            $question->text,
            $question->options->implode('text', ','),

        ];
    }
}


// class SurveyExport implements FromQuery, WithMapping
// {
//     use Exportable;
//     private $id;

//     public function __construct(int $id)
//     {
//         $this->id = $id;
//     }

//     /**
//      * @param Question $question
//      */
//     public function map($question): array
//     {
//         return [
//             $question->text,
//             ['asd', 'asd'],
//         ];
//     }
//     public function query()
//     {
//         $id = $this->id;
//         // return Questionnaire::query()->whereId($this->id)->with('questions')->orderBy('updated_at', 'desc');
//         // return Question::query()->whereId($this->id)->with('questions')->orderBy('updated_at', 'desc');

//         $a = Question::query()->whereHas('questionnaire', function ($query) use ($id) {
//             $query->where('questionnaire_id', '=', $id);
//         })->with('options')->orderBy('updated_at', 'desc');

//         return Question::query()->whereHas('questionnaire', function ($query) use ($id) {
//             $query->where('questionnaire_id', '=', $id);
//         })->with('options')->orderBy('updated_at', 'desc');
//     }
// }
