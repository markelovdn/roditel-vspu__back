<?php

namespace App\Filters;

use App\Models\Webinar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConsultationFilter extends QueryFilter
{

    public function searchField($search_string = '')
    {
        return $this->builder
            ->when($search_string, function ($query) use ($search_string) {
                $query->whereHas('messages', function ($query) use ($search_string) {
                    $query->where('text', 'LIKE', '%' . $search_string . '%');
                });
            })->orderBy('updated_at', 'ASC');
    }

    public function dateBetween($dates = null)
    {
        $before = Carbon::parse(Str::before($dates, ','))->format('Y-m-d-00:00:00');
        $after = Carbon::parse(Str::after($dates, ','))->format('Y-m-d-23:59:59');

        return $this->builder->when($dates, function ($query) use ($before, $after) {
            $query->whereBetween('updated_at', [$before, $after]);
        });
    }

    public function category($id = null)
    {
        return $this->builder->when($id, function ($query) use ($id) {
            $query->where('specialization_id', $id);
        });
    }

    public function actual($closed = null)
    {
        return $this->builder->when($closed, function ($query) use ($closed) {
            $query->where('closed', $closed === 'true' ? "=" : "<", 1);
        });
    }

    public function consultant($userId = null)
    {
        return $this->builder->when($userId, function ($query) use ($userId) {
            $query->whereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });
        });
    }
}
