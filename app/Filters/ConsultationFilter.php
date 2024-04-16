<?php

namespace App\Filters;

use App\Models\Consultation;
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

    // public function category($id = null)
    // {
    //     //TODO: разобраться с этим фильтром так как изменилась связь с таблицей ConsultationSpecialization
    //     return $this->builder->when($id, function ($query) use ($id) {
    //         $query->where('specialization_id', $id);
    //     });
    // }

    public function category($id = null)
    {
        return $this->builder->when($id, function ($query) use ($id) {
            // Фильтруем консультации по специализации, используя связи между юзерами и консультантами
            $query->whereHas('users.consultant.specializations', function ($query) use ($id) {
                $query->where('specializations.id', $id);
            });
        });
    }

    public function actual($actual = null)
    {
        return $this->builder->when($actual, function ($query) use ($actual) {
            $query->where('closed', $actual === 'yes' ? "=" : ">", 0);
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

    public function status($status = null)
    {
        $warning = Carbon::now()->subDays(Consultation::STATUS_WARNING_DAYS)->toDateTimeString();
        $danger = Carbon::now()->subDays(Consultation::STATUS_DANGER_DAYS)->toDateTimeString();

        return $this->builder
            ->when($status === Consultation::STATUS_NEW, function ($query) use ($warning) {
                $query->where('updated_at', '>', $warning);
            })
            ->when($status === Consultation::STATUS_WARNING, function ($query) use ($warning, $danger) {
                $query->whereBetween('updated_at', [$danger, $warning]);
            })
            ->when($status === Consultation::STATUS_DANGER, function ($query) use ($danger) {
                $query->whereDate('updated_at', '<=', $danger);
            });
    }
}
