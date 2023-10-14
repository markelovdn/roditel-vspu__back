<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearResetTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-reset-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        DB::table('password_reset_tokens')->where('created_at', '<', Carbon::now()->subMinutes(1))->delete();
    }
}

//TODO:сделать автоматическую очистку таблицу токенов
