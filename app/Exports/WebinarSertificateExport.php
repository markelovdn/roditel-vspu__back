<?php

namespace App\Exports;

use App\Models\Questionnaire;
use App\Models\Webinar;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class WebinarSertificateExport implements FromView
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

        $webinar = Webinar::query()->with('partisipants')->where('id', $id)->first();

        return view('certificates.certificates', [
            'webinar' => $webinar
        ]);
    }
}
