<?php

namespace App\Exports;

use App\Models\Questionnaire;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class SurveyExport implements FromQuery
{
    use Exportable;
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        //TODO:сделать нормальную выгрузку с вопросами и ответами
        return Questionnaire::with('questions')->where('id', $this->id)->first();
    }

}
