<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WebinarCategory extends Model
{
    use HasFactory;

    public function webinar(): HasOne {
        return $this->hasOne(Webinar::class);
    }
}
