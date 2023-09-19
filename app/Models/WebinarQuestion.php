<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebinarQuestion extends Model
{
    use HasFactory;

    public function webinar(): BelongsTo {
        return $this->belongsTo(Webinar::class);
    }
}
