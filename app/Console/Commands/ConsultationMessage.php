<?php

namespace App\Console\Commands;

use App\Events\ConsultationEvent;
use App\Events\TranslationEvent;
use Illuminate\Console\Command;

class ConsultationMessage extends Command
{

    protected $signature = 'translation:messages {id} {message}';
    protected $description = 'Fire event';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        event(
            new ConsultationEvent(
                $this->argument('id'),
                $this->argument('message')
            )
        );
    }
}
