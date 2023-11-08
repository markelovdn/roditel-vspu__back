<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Webinar extends Model
{
    use HasFactory;

    public function webinarCategory(): BelongsTo {
        return $this->belongsTo(WebinarCategory::class);
    }

    public function program(): HasOne {
        return $this->hasOne(WebinarProgram::class);
    }

    public function questions(): HasMany {
        return $this->hasMany(WebinarQuestion::class);
    }

    public function lectors(): BelongsToMany {
        return $this->BelongsToMany(Lector::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter){
        return $filter->apply($builder);
    }
}
