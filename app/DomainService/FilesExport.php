<?php

namespace App\DomainService;

use App\Exports\SurveyExport;
use App\Exports\WebinarSertificateExport;
use App\Models\Parented;
use App\Models\Webinar;
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
        $parented = Parented::with('user')->where('user_id', auth()->user()->id)->first()->user;

        $webinarDate = Carbon::parse($webinar->date)->format('d.m.Y') . ' г.';

        $firstLetters = strpos($webinar->title, ':') ? explode(':', $webinar->title)[0] : explode(' ', $webinar->title)[0];
        $numberOfParticipant = DB::table('webinar_partisipants')
            ->where('webinar_id', $id)
            ->pluck('user_id')
            ->search(auth()->user()->id);

        $webinarRegNumber = implode('', array_map(function ($word) {
            return mb_strtoupper(mb_substr(trim($word), 0, 1));
        }, explode(' ', $firstLetters))) . $webinar->id . '-' . Carbon::parse($webinar->date)->format('dmy') . '-' . $numberOfParticipant;

        $html = View::make('certificates.certificates', [
            'webinar' => $webinar,
            'webinarDate' => $webinarDate,
            'parented' => $parented,
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
}
