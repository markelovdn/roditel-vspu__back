<?php
namespace App\BusinessProcess;

use App\Models\WebinarPartisipant;

class WebinarParticipants
{
    public function isUnique(int $webinar_id, int $user_id): bool {

        $webinarPartisipant = WebinarPartisipant::where('webinar_id', $webinar_id)
        ->where('user_id', $user_id)->get();

        if($webinarPartisipant->count() > 0) {
            return false;
        }

        return true;

    }
}
