<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class Consultant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'photo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contract(): HasOne
    {
        return $this->hasOne(Contract::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(ConsultantReport::class);
    }

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }

    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }

    public function consultantAnsweres(): HasMany
    {
        return $this->hasMany(ConsultantAnswer::class)->with('consultation');
    }

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    public function consultantAnswers(): HasMany
    {
        return $this->hasMany(ConsultantAnswer::class);
    }

    public function questionnaires(): HasMany
    {
        return $this->hasMany(Questionnaire::class)->with('questions');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
