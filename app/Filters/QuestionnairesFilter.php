<?php

namespace App\Filters;

use App\Models\ConsultantReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionnairesFilter extends QueryFilter {

    // public function dateBetween($dates = null){
    //     $before = Carbon::parse(Str::before($dates, ','))->format('Y-m-d');
    //     $after = Carbon::parse(Str::after($dates, ','))->format('Y-m-d');

    //     // $db = DB::table('consultant_reports')->whereRaw('DATE(updated_at) = ?', [$before])->get();

    //     return $this->builder->when($dates, function($query) use($before, $after){
    //         $query->whereRaw('DATE(updated_at) = ?', [$before]);

    //     });
    // }

    public function status($status = null){
        return $this->builder->when($status, function($query) {
            $query->where('status', '!=', null);
        });
    }


}
