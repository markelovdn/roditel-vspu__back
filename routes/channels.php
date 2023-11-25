<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('Consultation.{id}', function ($user, $id) {

    $consultation = App\Models\Consultation::find($id);
    if ($consultation && $consultation->users()->where('user_id', $user->id)->exists()) {
        return true;
    }
    return false;
});
