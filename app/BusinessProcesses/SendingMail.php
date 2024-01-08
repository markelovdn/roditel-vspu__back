<?php

namespace App\BusinessProcesses;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendingMail
{
    public static function newUser(User $user): void
    {
        $email = User::where('role_id', Role::where('code', Role::ADMIN)->first()->id)->first()->email;
        $role = Role::where('code', $user->role->code)->first();

        Mail::send('newUser', ['user' => $user->first_name . ' ' . $user->patronymic . ' ' . $user->second_name, 'email' => $user->email, 'role' => $role->title], function ($message) use ($email, $role) {
            $message->to($email);
            $message->subject('Зарегистрирован новый' . ' ' . Str::lower($role->title));
        });
    }
}
