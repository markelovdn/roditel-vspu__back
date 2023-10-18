<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WebinarLector extends Model
{
    use HasFactory;

    public function webinar(): BelongsTo {
        return $this->belongsTo(Webinar::class);
    }

    public function programs(): BelongsToMany {
        return $this->belongsToMany(WebinarProgram::class);
    }


}
