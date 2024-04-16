<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class ConsultantReport extends Model
{
    use HasFactory;

    public const UPLOAD_SUCCESSFUL = 'success';
    public const UPLOAD_FAILED = 'fail';

    public function consultant(): BelongsToMany {
        return $this->belongsToMany(Consultant::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter){
        return $filter->apply($builder);
    }
}
