<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Questionnaire extends Model
{
    use HasFactory, SoftDeletes;

    public function consultant(): BelongsTo {
        return $this->belongsTo(Consultant::class);
    }

    public function questions(): BelongsToMany {
        return $this->belongsToMany(Question::class)->with('answers');
    }

    public function storeQuestions($questions, $questionnaireId) {
        $questionnaire = Questionnaire::find($questionnaireId);

        foreach ($questions as $item) {
            $question = new Question();

            $question->text = $item['text'];
            $question->answer_type = $item['answerType'];
            $question->save();

            $questionnaire->questions()->attach($question->id);
            
            $question->storeAnswere($item['answers'], $question->id);
        }
    }

}
