<?php

namespace App\DomainService;

use App\Models\Consultant;
use App\Models\ConsultantReport;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FilesHandler
{
    private $resize = 354;

    public function uploadPhoto(int $user_id, object $file): string
    {
        // $file->openFile()->fread($file->getSize())

        $img = Image::make($file)->resize($this->resize, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $filecontent = $img->stream();

        $filePath = '/consultants/photo/';

        if (Storage::disk('public')->put($filePath . $user_id . '_photo.' . $file->extension(), $filecontent->__toString())) {
            return config('filesystems.disks.public.url') . $filePath . $user_id . '_photo.' . $file->extension();
        }

        return response()->json(['error' => 'Uploaded photo error'], 400);
    }

    public function uploadWebinarLogo(object $file): string
    {
        // $file->openFile()->fread($file->getSize());
        $img = Image::make($file)->resize($this->resize, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $filecontent = $img->stream();

        $filePath = '/webinars/';

        if (Storage::disk('public')->put($filePath . '_logo.' . $file->extension(), $filecontent->__toString())) {
            return config('filesystems.disks.public.url') . $filePath . '_logo.' . $file->extension();
        }

        return response()->json(['error' => 'Uploaded logo error'], 400);
    }

    public function uploadLectorPhoto(object $file, $lector_name): string
    {
        // $file->openFile()->fread($file->getSize());
        $img = Image::make($file)->resize($this->resize, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $filecontent = $img->stream();


        $filePath = '/webinars/lectors_photo/';

        if (Storage::disk('public')->put($filePath . '_.' . $lector_name . '.' . $file->extension(), $filecontent->__toString())) {
            return config('filesystems.disks.public.url') . $filePath . '_.' . $lector_name . '.' . $file->extension();
        }

        return response()->json(['error' => 'Uploaded lector_photo error'], 400);
    }

    public function uploadConsultantReport(int $consultant_id, object $file): string
    {
        $filePath = '/consultants/reports/';
        $concultantId = $consultant_id;
        $fileName = 'Файл_' . count(ConsultantReport::where('consultant_id', $consultant_id)->get()) + 1;

        if (Storage::disk('public')->put($filePath . $fileName . '.' . $file->extension(), $file->openFile()->fread($file->getSize()))) {
            return config('filesystems.disks.public.url') . $filePath . $fileName . '.' . $file->extension();
        }

        return response()->json(['error' => 'Uploaded report error'], 400);
    }
}
