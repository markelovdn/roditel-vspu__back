<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class Questionnaire extends Model
{
    use HasFactory, SoftDeletes;

    public function consultant(): BelongsTo
    {
        return $this->belongsTo(Consultant::class);
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class)->with('options', 'optionOther');
    }

    public function parented(): BelongsToMany
    {
        return $this->belongsToMany(Parented::class)->with('user', 'children');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
