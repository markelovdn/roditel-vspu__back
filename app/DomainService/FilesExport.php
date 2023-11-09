<?php

namespace App\DomainService;

use App\Exports\SurveyExport;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FilesExport
{
    public static function surveyExport($fileUrl, $id)
    {
        //TODO: закрыть функцию для не авторизованых пользователей по токену
        // return Excel::store(new SurveyExport($id), Str::after($fileUrl, config('filesystems.disks.public.url')), 'public');

        return (new SurveyExport($id))->store(Str::after($fileUrl, config('filesystems.disks.public.url')), 'public');
    }
}
