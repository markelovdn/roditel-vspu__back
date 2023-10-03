<?php

namespace App\Filters;

use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WebinarFilter extends QueryFilter {

    public function category($id = null)
    {
        return $this->builder->when($id, function ($query) use ($id) {
            $query->where('webinar_category_id', $id);
        });
    }

    public function dateActual($date = null){
        return $this->builder->when($date, function($query) use($date){
            $query->where('date', '>', $date);
        });
    }

    public function dateArchive($date = null){
        return $this->builder->when($date, function($query) use($date){
            $query->where('date', '<', $date);
        });
    }

    public function dateBetween($dates = null){
        return $this->builder->when($dates, function($query) use($dates){
            $query->whereBetween('date', [Str::before($dates, ','), Str::after($dates, ',')]);
        });
    }

    public function lector($lector_name = null){
        return $this->builder->when($lector_name, function($query) use($lector_name){
            $query->where('lector_name', '=', $lector_name);
        });
    }

    public function search_field($search_string = ''){
        return $this->builder
            ->when($search_string, function($query) use($search_string){
            $query->where('title', 'LIKE', '%'.$search_string.'%');})->orderBy('title', 'ASC');
    }


}
