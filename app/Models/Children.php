<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Children extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_birth',
    ];

    public function parented(): BelongsTo {
        return $this->belongsTo(Parented::class)->with('user');
    }
}
