<?php

use App\Console\Commands\ClearResetTokens;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Artisan::command('clear-reset-tokens');
