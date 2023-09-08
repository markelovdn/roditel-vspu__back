<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ConsultantReport extends Model
{
    use HasFactory;

    public function consultant(): BelongsToMany {
        return $this->belongsToMany(Consultant::class);
    }
}
