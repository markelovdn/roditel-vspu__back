<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vebinar extends Model
{
    use HasFactory;

    public function vebinarCategory(): BelongsTo {
        return $this->belongsTo(VebinarCategory::class);
    }

    public function program(): HasOne {
        return $this->hasOne(VebinarProgram::class);
    }

    public function question(): HasOne {
        return $this->hasOne(VebinarQuestion::class);
    }
}
