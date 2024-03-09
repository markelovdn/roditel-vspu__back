<?php

namespace App\BusinessProcesses;

use App\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GetWebinarRegNumber
{
    public static function execute(Webinar $webinar)
    {
        $prefixSertificate = $webinar->prefix_sertificate;
        $numberSertificate = $webinar->number_sertificate;
        $numberOfParticipant = DB::table('webinar_partisipants')
            ->where('webinar_id', $webinar->id)
            ->count();

        return implode('', array_map(function ($word) {
            return mb_strtoupper(mb_substr(trim($word), 0, 1));
        }, explode(' ', $prefixSertificate))) . $webinar->id . '-' . Carbon::parse($webinar->date)->format('dmy') . '-' . $numberSertificate + $numberOfParticipant + 1;
    }
}
