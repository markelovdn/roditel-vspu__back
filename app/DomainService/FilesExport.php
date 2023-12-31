<?php

namespace App\DomainService;

use App\BusinessProcesses\GetWebinarRegNumber;
use App\Exports\SurveyExport;
use App\Exports\WebinarPartisipantsExport;
use App\Exports\WebinarSertificateExport;
use App\Models\Parented;
use App\Models\Webinar;
use App\Models\WebinarPartisipant;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class FilesExport
{
    public static function surveyExport($fileUrl, $id)
    {
        return Excel::store(new SurveyExport($id), Str::after($fileUrl, config('filesystems.disks.public.url')), 'public');
    }

    public static function webinarSertificateExport($id)
    {
        $webinar = Webinar::query()->where('id', $id)->first();

        $webinarRegNumber = WebinarPartisipant::where('webinar_id', $webinar->id)->where('user_id', auth()->user()->id)->first()->sertificate_number;

        $html = View::make('certificates.certificates', [
            'webinar' => $webinar,
            'webinarDate' => Carbon::parse($webinar->date)->format('d.m.Y') . ' г.',
            'parented' => Parented::with('user')->where('user_id', auth()->user()->id)->first()->user,
            'webinarRegNumber' => $webinarRegNumber
        ])->render();

        $dompdf = new Dompdf();

        $options = new Options();
        $options->set('defaultPaperSize', 'A4');
        $options->set('defaultPaperOrientation', 'landscape');
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);

        $dompdf->loadHtml($html);
        $dompdf->render();

        $filePath = '/webinars/sertificates/';
        $fileName = $webinarRegNumber . '.pdf';
        $path = storage_path('/app/public' . $filePath . $fileName);

        File::put($path, $dompdf->output());

        return config('filesystems.disks.public.url') . $filePath . $fileName;
    }

    public static function webinarPartisipantsExport($id)
    {
        $filePath = '/webinars/';
        $fileName = 'webinar_participants_' . $id . '.xls';

        Excel::store(new WebinarPartisipantsExport($id), $filePath . $fileName, 'public');

        return config('filesystems.disks.public.url') . $filePath . $fileName;
    }
}
