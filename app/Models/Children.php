<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\JsonResponse;

class Children extends Model
{
    use HasFactory;

    protected $fillable = [
        'parented_id',
        'age',
    ];

    public function parented(): BelongsTo
    {
        return $this->belongsTo(Parented::class)->with('user');
    }

    public static function isAdult(int $age): JsonResponse | bool
    {
        return $age >= 18 ? true : false;
    }

    public static function newChildren(object $data, int $parented_id): void
    {
        Children::create([
            'age' => $data->age,
            'parented_id' => $parented_id,
        ]);
    }

    public static function updateChildren(object $children, object $data): void
    {
        Children::where('id', $children->id)->update(['age' => $data->age]);
    }

    public static function deleteChildren(int $id, int $parented_id): void
    {
        Children::destroy(Children::where(['id' => $id, 'parented_id' => $parented_id])->first()->id);
    }
}
