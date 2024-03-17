<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultationRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'rating_question_id',
        'rating_answer',
    ];

    public function rating(): BelongsTo
    {
        return $this->belongsTo(RatingQuestion::class);
    }

    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }
}
