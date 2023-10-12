<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Mail\InvoicePaid;
use App\Mail\Notification;
use App\Models\Consultant;

class MailTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_send_mail(): void
    {

        Mail::send(['text' => 'mail'], ['name', 'my name'], function($message) {
            $message->to('markelovdn@gmail.com', 'to my')->subject('Test mail');
            $message->from('lion831@yandex.ru', 'to my');
        });
        // $user = User::findOrFail(100);

        // Ship the order...

        // Mail::to($user)->send(new Notification());
    }
}
