<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultationMessage extends Model
{
    use HasFactory;

    public function consultations(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mapInto($data)
    {
        // Логика преобразования данных

        return $this; // или возвращайте объект, с которым вы хотите работать
    }
}
