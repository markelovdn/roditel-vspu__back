<?php

namespace App\Filters;

use App\Models\ConsultantReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConsultantReportsFilter extends QueryFilter {

    public function dateBetween($dates = null){
        $before = Carbon::parse(Str::before($dates, ','))->format('Y-m-d-00:00:00');
        $after = Carbon::parse(Str::after($dates, ','))->format('Y-m-d-23:59:59');

        return $this->builder->when($dates, function($query) use($before, $after){
            $query->whereBetween('updated_at', [$before, $after]);;

        });
    }


}
