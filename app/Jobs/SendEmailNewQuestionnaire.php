<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailNewQuestionnaire implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $consultant;


    /**
     * Create a new job instance.
     *
     * @param string $email
     * @param string $messageText
     */
    public function __construct($email, $consultant)
    {
        $this->email = $email;
        $this->consultant = $consultant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Mail::send('newQuestionnaire', ['consultant' => $this->consultant, 'email' => $this->email], function ($message) {
            $message->to($this->email);
            $message->subject('Новая анкета');
        });
    }
}
