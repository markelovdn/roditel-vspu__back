<?php

use App\Models\Consultation;
use App\Models\Role;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;

Broadcast::channel('Consultation.{id}', function ($user, $id) {

    if ($user->role->code === Role::PARENTED) {
        $consultation = Consultation::where('id', $id)
            ->where('parented_user_id', $user->id)
            ->first();

        if ($consultation) {
            return true;
        }
    }

    if ($user->role->code === Role::CONSULTANT) {
        $consultation = Consultation::where('id', $id)
            ->where('consultant_user_id', $user->id)
            ->first();

        if ($consultation) {
            return true;
        }
    }

    return false;
});
