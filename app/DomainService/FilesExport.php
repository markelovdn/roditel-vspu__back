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
        return Excel::store(new SurveyExport($id), Str::after($fileUrl, config('filesystems.disks.public.url')), 'public');
    }
}
