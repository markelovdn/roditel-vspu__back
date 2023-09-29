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
}
