<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VebinarProgram extends Model
{
    use HasFactory;

    public function vebinarProgram(): BelongsTo {
        return $this->belongsTo(Vebinar::class);
    }
}
