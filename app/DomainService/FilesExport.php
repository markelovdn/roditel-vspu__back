<?php

namespace App\DomainService;

use App\Exports\SurveyExport;
use App\Exports\WebinarSertificateExport;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FilesExport
{
    public static function surveyExport($fileUrl, $id)
    {
        return Excel::store(new SurveyExport($id), Str::after($fileUrl, config('filesystems.disks.public.url')), 'public');
    }

    public static function webinarSertificateExport($fileUrl, $id)
    {
        return Excel::store(new WebinarSertificateExport($id), Str::after($fileUrl, config('filesystems.disks.public.url')), 'public');
    }
}
