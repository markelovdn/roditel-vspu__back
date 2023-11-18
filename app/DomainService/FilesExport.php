<?php

namespace App\DomainService;

use App\Exports\SurveyExport;
use Carbon\Carbon;
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

    // public static function surveyExport($id)
    // {
    //     //TODO: закрыть функцию для не авторизованых пользователей по токену
    //     // return Excel::store(new SurveyExport($id), Str::after($fileUrl, config('filesystems.disks.public.url')), 'public');

    //     return (new SurveyExport($id))->store(Str::after(config('filesystems.disks.public.url') . '/consultants/questionnaires/sample' . Carbon::now()->format('d.m.Y') . '.xlsx', config('filesystems.disks.public.url')), 'public');
    // }
}
