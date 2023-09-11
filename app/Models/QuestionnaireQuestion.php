<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionnaireQuestion extends Model
{
    use HasFactory;

    public function questionnaire(): BelongsTo {
        return $this->belongsTo(Questionnaire::class);
    }

    public function questionnaireAnswers (): HasMany {
        return $this->hasMany(QuestionnaireAnswer::class);
    }
}
