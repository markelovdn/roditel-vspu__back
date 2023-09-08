<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VebinarQuestion extends Model
{
    use HasFactory;

    public function vebinarQuestion(): BelongsTo {
        return $this->belongsTo(Vebinar::class);
    }
}
