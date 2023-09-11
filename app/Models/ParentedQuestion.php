<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParentedQuestion extends Model
{
    use HasFactory;

    public function consultantAnswer(): HasMany
    {
        return $this->hasMany(ConsultantAnswer::class);
    }

    public function consultations(): BelongsTo {
        return $this->belongsTo(Consultation::class);
    }

    public function parented(): BelongsTo {
        return $this->belongsTo(Parented::class);
    }
}
