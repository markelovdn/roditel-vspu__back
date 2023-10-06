<?php

namespace App\DomainService;

use Illuminate\Support\Facades\Storage;

class FilesHandler
{
    public function uploadPhoto(int $user_id, object $file): string
    {
        $filePath = '/consultants/photo/';

        if (Storage::disk('local')->put($filePath.$user_id.'_photo.'.$file->extension(), $file->openFile()->fread($file->getSize())))
        {
            return config('filesystems.disks.public.url').$filePath.$user_id.'_photo.'.$file->extension();
        }

        return response()->json(['error' => 'Uploaded photo error'], 400);
    }

    public function uploadWebinarLogo(object $file): string
    {
        $filePath = '/webinars/';

        if (Storage::disk('local')->put($filePath.'_logo.'.$file->extension(), $file->openFile()->fread($file->getSize())))
        {
            return config('filesystems.disks.public.url').$filePath.'_logo.'.$file->extension();
        }

        return response()->json(['error' => 'Uploaded logo error'], 400);
    }

    public function uploadConsultantReport(int $consultant_id, object $file): string
    {
        $filePath = '/consultants/reports/';
        $concultantId = $consultant_id;

        if (Storage::disk('local')->put($filePath.'_report_concultant_id_.'.$concultantId.'.'.$file->extension(), $file->openFile()->fread($file->getSize())))
        {
            return config('filesystems.disks.public.url').$filePath.'_report_concultant_id_.'.$concultantId.'.'.$file->extension();
        }

        return response()->json(['error' => 'Uploaded report error'], 400);
    }
}
