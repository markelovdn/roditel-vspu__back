<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends Model
{
    use HasFactory;

    public function parented(): BelongsTo {
        return $this->belongsTo(Parented::class)->with('parentedQuestions');
    }

    public function consultant(): BelongsTo {
        return $this->belongsTo(Consultant::class)->with('consultantAnswers');
    }
}
