<?php

namespace App\DomainService;

use App\Exports\SurveyExport;
use App\Http\Requests\SurveyEportRequest;
use Maatwebsite\Excel\Facades\Excel;

class FilesExport
{
    public function surveyExport(SurveyEportRequest $request)
    {
        //TODO: закрыть функцию для не авторизованых пользователей по токену
        return (new SurveyExport)->store('/consultants/surveys/survey_'.$request->id.'.xlsx', 'public');
    }
}
