<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;

Broadcast::channel('Consultation.{id}', function ($user, $id) {

    $consultations = DB::table('consultation_user')
        ->where('consultation_id', $id)
        ->where('user_id', $user->id)->get();

    if ($consultations->count() > 0) {
        return true;
    }
    return false;
});
