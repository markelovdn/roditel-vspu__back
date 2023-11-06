<?php

namespace App\Exports;

use App\Http\Resources\QuestionnairesResource;
use App\Models\Questionnaire;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;

class SurveyExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return Questionnaire::with('questions')->where('id', Request::post('id'))->first();
    }
}
