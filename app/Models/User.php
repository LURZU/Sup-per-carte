<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function favorites()
    {
        return $this->belongsToMany(Card::class, 'student_card_fav', 'user_id', 'card_id');
    }

    
    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'matiere_user', 'user_id', 'matiere_id');
    }

    public function card_status_user()
    {
        return $this->belongsToMany(Card::class, 'user_status_card', 'user_id', 'card_id');
    }

    public function setStatusCard($list_card_all) {
        foreach ($list_card_all as $card) {
            $card->card_status = $this->where('id', $card->status_card_id)->first()->label;
        }
        return $list_card_all;
    }


    public function hasRole($role): bool {
        if($this->roles()->first()->name === $role) {
            return true;
        }
        return false;
    }

    
}
