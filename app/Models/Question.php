<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    public const ONE = 'one';
    public const MANY = 'many';
    public const FREE = 'free';

    public function questionnaire(): BelongsToMany {
        return $this->belongsToMany(Questionnaire::class);
    }

    public function answers(): BelongsToMany {
        return $this->belongsToMany(Answer::class);
    }

    public function storeAnswere($answers, $questionId) {
        $question = Question::find($questionId);

        foreach ($answers as $item) {
            $answer = new Answer();

            $answer->text = $item['text'];
            $answer->save();

            $question->answers()->attach($answer->id);

        }
    }

}
