<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionnaireAnswerCount extends Model
{
    use HasFactory;

    public function questionnaireQuestions (): BelongsTo {
        return $this->belongsTo(QuestionnaireQuestion::class);
    }

    public function questionnaireAnswers (): BelongsTo {
        return $this->BelongsTo(QuestionnaireAnswer::class);
    }

    public function questionnaireParentedAnswer(): BelongsTo {
        return $this->belongsTo(QuestionnaireParentedAnswer::class);
    }
}
