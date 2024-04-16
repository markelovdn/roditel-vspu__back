<?php

namespace App\Console\Commands;

use App\Models\Consultation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearNotActiveOldConsultations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-not-active-old-consultations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        Consultation::whereDate('created_at', '<', Carbon::now()->subDays(Consultation::STATUS_DANGER_DAYS)->toDateTimeString())->delete();
    }
}
