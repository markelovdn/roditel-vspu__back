<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailAnsweredToQuestionnaire implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $parented;


    /**
     * Create a new job instance.
     *
     * @param string $email
     * @param string $messageText
     */
    public function __construct($email, $parented)
    {
        $this->email = $email;
        $this->parented = $parented;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Mail::send('newAnsweredToQuestionnaire', ['parented' => $this->parented, 'email' => $this->email], function ($message) {
            $message->to($this->email);
            $message->subject('Ответы на анкету');
        });
    }
}
