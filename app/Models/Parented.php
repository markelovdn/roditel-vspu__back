<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parented extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function childrens(): HasMany {
        return $this->hasMany(Children::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function consultations(): HasMany {
        return $this->hasMany(Consultation::class)->with('parentedQuestion');
    }

    public function parentedQuestions(): HasMany {
        return $this->hasMany(ParentedQuestion::class);
    }


}
