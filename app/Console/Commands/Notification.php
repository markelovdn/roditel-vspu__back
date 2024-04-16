<?php

namespace App\Console\Commands;

use App\Events\ConsultationEvent;
use App\Events\NotificationEvent;
use App\Events\TranslationEvent;
use Illuminate\Console\Command;

class Notification extends Command
{

    protected $signature = 'translation:notification {id} {message} {questionnaires} {count}';
    protected $description = 'Fire event';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        event(
            new NotificationEvent(
                $this->argument('id'),
                $this->argument('message'),
                $this->argument('questionnaires'),
                $this->argument('count')
            )
        );
    }
}
