<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SelectedOption extends Model
{
    use HasFactory;

    public function questions(): BelongsToMany {
        return $this->belongsToMany(Question::class);
    }

    public function options(): BelongsToMany {
        return $this->belongsToMany(Option::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }


}
