<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Role extends Model
{
    use HasFactory;

    public const CONSULTANT = 'consultant';
    public const PARENTED = 'parented';
    public const ADMIN = 'admin';

    protected $fillable = [
        'title',
    ];

    public function user(): HasOne {
        return $this->hasOne(User::class);
    }

    public function isAdmin(int $user_id): bool {
        $role = Role::where('code', Role::ADMIN)->first();
        $admin = User::where('id', $user_id)
        ->where('role_id', $role->id)->first();

        return !$admin ? false : true;
    }

    public function isConsultant(int $user_id): bool {
        $role = Role::where('code', Role::CONSULTANT)->first();
        $consultant = User::where('id', $user_id)
        ->where('role_id', $role->id)->first();

        return !$consultant ? false : true;
    }

    public function isParented(int $user_id): bool {
        $role = Role::where('code', Role::PARENTED)->first();
        $parented = User::where('id', $user_id)
        ->where('role_id', $role->id)->first();

        return !$parented ? false : true;
    }

}
