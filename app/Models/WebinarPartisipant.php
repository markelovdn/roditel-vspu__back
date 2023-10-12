<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebinarPartisipant extends Model
{
    use HasFactory;

    public function users(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function isUnique(int $webinar_id, int $user_id): bool {

        $webinarPartisipant = WebinarPartisipant::where('webinar_id', $webinar_id)
        ->where('user_id', $user_id)->get();

        if($webinarPartisipant->count() > 0) {
            return false;
        }

        return true;

    }
}
