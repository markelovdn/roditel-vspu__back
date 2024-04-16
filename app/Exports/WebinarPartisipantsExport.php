<?php

namespace App\Exports;

use App\Models\Questionnaire;
use App\Models\User;
use App\Models\Webinar;
use App\Models\WebinarPartisipant;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class WebinarPartisipantsExport implements FromView
{
    use Exportable;
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $id = $this->id;

        $participants = User::query()
            ->join('webinar_partisipants', 'users.id', '=', 'webinar_partisipants.user_id')
            ->join('parenteds', 'users.id', '=', 'parenteds.user_id')
            ->join('regions', 'parenteds.region_id', '=', 'regions.id')
            ->where('webinar_partisipants.webinar_id', $id)
            ->select('users.*', 'regions.title as region_title')
            ->get();

        return view('webinarPartisipants', [
            'participants' => $participants
        ]);
    }
}
