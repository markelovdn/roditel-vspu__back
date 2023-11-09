<?php

namespace App\Exports;

use App\Models\Questionnaire;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SurveyExport implements FromCollection, WithHeadings
{
    use Exportable;
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function headings(): array
    {
        return [
            '#',
            'User',
            'Date',
        ];
    }
    public function collection()
    {
        // return Questionnaire::query()->whereId($this->id)->with('questions')->orderBy('updated_at', 'desc');
        return Questionnaire::where($this->id)->with('questions')->first();
    }

}
