<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'id',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function parented(): HasOne
    {
        return $this->hasOne(Parented::class);
    }

    public function consultant(): HasOne
    {
        return $this->hasOne(Consultant::class)->with('contract');
    }

    public function consultations(): BelongsToMany
    {
        return $this->belongsToMany(Consultation::class)->with('contract');
    }

    public function consultationMessages(): HasMany
    {
        return $this->hasMany(ConsultationMessage::class);
    }

    public function webinar(): HasMany
    {
        return $this->hasMany(WebinarPartisipant::class);
    }

    public function selectedOptions(): HasMany
    {
        return $this->hasMany(SelectedOption::class);
    }

    public function registrationAs(object $user, $request): void
    {

        $role = new Role();

        if ($role->isConsultant($user->id)) {

            $consultant = Consultant::firstOrCreate([
                'user_id' => $user->id,
            ], [
                'profession_id' => $request->professionId,
            ]);

            if (is_array($request->specializationsId)) {
                $consultant->specializations()->syncWithoutDetaching($request->specializationsId);
            } else {
                $consultant->specializations()->syncWithoutDetaching([$request->specializationsId]);
            }
        } else {
            Parented::create([
                'user_id' => $user->id,
                'region_id' => $request->regionId,
            ]);
        }
    }

    public function isAdmin(): bool
    {
        return Auth::check() && Auth::user()->role->code == Role::ADMIN;
    }
}
