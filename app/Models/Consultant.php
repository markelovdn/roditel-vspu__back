<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultant extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function contract(): BelongsTo {
        return $this->belongsTo(Contract::class);
    }

    public function specialization(): BelongsTo {
        return $this->belongsTo(Specialization::class);
    }

    public function proffession(): BelongsTo {
        return $this->belongsTo(Proffesion::class);
    }


}
