<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('App.Models.Consultation.{id}', function ($id) {
    // $consultation = App\Models\Consultation::find($id);
    // if ($consultation && $consultation->users()->where('user_id', $user->id)->exists()) {
    //     return true;
    // }
    // return false;
    return $id === 21;
});

// Broadcast::channel('Consultation.93', function () {
//     // return (int) $user->id === (int) $id;
//     return true;
// });
