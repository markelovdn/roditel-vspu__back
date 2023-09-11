<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questionnaire extends Model
{
    use HasFactory;

    public function questionnaireQuestions(): HasMany {
        return $this->hasMany(QuestionnaireQuestion::class)->with('questionnaireAnswers');
    }
}
