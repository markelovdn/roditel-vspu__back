<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function consultant(): HasOne {
        return $this->hasOne(Consultant::class);
    }
}
