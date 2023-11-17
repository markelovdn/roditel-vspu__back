<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    public const TEXT = 'text';
    public const SINGLE = 'single';
    public const MANY = 'many';

    public function questionnaire(): BelongsToMany
    {
        return $this->belongsToMany(Questionnaire::class);
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    public function optionOther(): HasOne
    {
        return $this->hasOne(OptionOther::class);
    }

    public function selectedOptions(): HasMany
    {
        return $this->HasMany(SelectedOption::class);
    }
}
