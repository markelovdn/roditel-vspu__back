<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function Laravel\Prompts\text;

class RatingQuestion extends Model
{
    use HasFactory;

    const RATING_NUMBER = "number";
    const RATING_TEXT = "text";

    public function consultations(): HasMany
    {
        return $this->hasMany(ConsultationRating::class);
    }
}
