<?php

namespace App\Http\Controllers;

use App\Mail\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send () {
        // $user = ['name'=>'me name'];
        // Mail::send(['text' => 'mail'], [], function($message) {
        //     $message->to('markelovdn@gmail.com', 'to my')->subject('Test mail');
        //     $message->from('lion831@yandex.ru', 'to my');
        // });

        $user = User::findOrFail(100);

        // Ship the order...

        Mail::to($user)->send(new Notification($user));
    }
}
