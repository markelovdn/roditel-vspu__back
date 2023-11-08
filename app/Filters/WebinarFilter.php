<?php

namespace App\Filters;

use App\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebinarFilter extends QueryFilter {

    public function category($id = null)
    {
        return $this->builder->when($id, function ($query) use ($id) {
            $query->where('webinar_category_id', $id);
        });
    }

    public function actual($actual = null){
        return $this->builder->when($actual, function($query) use($actual) {
            $query->where('date', $actual === 'yes' ? ">=" : "<", Carbon::now()->format('Y-m-d'));
        });
    }

    public function dateBetween($dates = null){
        $before = Carbon::parse(Str::before($dates, ','))->format('Y-m-d');
        $after = Carbon::parse(Str::after($dates, ','))->format('Y-m-d');

        return $this->builder->when($dates, function($query) use($before, $after){
            $query->whereBetween('date', [$before, $after]);
        });
    }

    public function lector($lector_id = null){
        return $this->builder->when($lector_id, function($query) use($lector_id) {
            $query->whereHas('lectors', function ($q) use ($lector_id) {
                $q->where('lector_id', $lector_id);});
        });
    }

    public function searchField($search_string = ''){
        return $this->builder
            ->when($search_string, function($query) use($search_string){
            $query->where('title', 'LIKE', '%'.$search_string.'%');})->orderBy('title', 'ASC');
    }


}
