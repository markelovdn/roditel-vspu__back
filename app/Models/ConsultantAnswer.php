<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultantAnswer extends Model
{
    use HasFactory;

    public function parentedQuestion(): BelongsTo {
        return $this->belongsTo(ParentedQuestion::class);
    }
}
