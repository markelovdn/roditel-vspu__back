<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebinarProgram extends Model
{
    use HasFactory;

    public function webinarProgram(): BelongsTo {
        return $this->belongsTo(Webinar::class);
    }
}
