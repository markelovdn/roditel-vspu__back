<?php

namespace App\Filters;

use App\Models\Consultation;
use App\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConsultantFilter extends QueryFilter
{

    public function search($search_string = '')
    {
        return $this->builder
            ->when($search_string, function ($query) use ($search_string) {
                $query->whereHas('user', function ($query) use ($search_string) {
                    $query->where('second_name', 'LIKE', '%' . $search_string . '%')
                        ->orWhere('first_name', 'LIKE', '%' . $search_string . '%')
                        ->orWhere('patronymic', 'LIKE', '%' . $search_string . '%');
                });
            })->orderBy('updated_at', 'ASC');
    }
}
